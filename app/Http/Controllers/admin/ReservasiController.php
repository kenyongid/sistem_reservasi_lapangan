<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Menampilkan semua reservasi.
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'created_at');

        $reservasi = Reservasi::with([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu',
        ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ]);

        switch ($sort) {

            case 'created_at':
                // Reservasi terbaru dibuat lebih dahulu
                $reservasi->orderBy('created_at', 'desc');
                break;

            case 'oldest':
                // Reservasi yang paling lama dibuat lebih dahulu
                $reservasi->orderBy('created_at', 'asc');
                break;

            case 'tanggal_asc':
                // Tanggal reservasi terdekat
                $reservasi->orderBy('tanggal', 'asc');
                break;

            case 'tanggal_desc':
                // Tanggal reservasi terjauh
                $reservasi->orderBy('tanggal', 'desc');
                break;

            case 'status':
                $reservasi->orderBy('status', 'asc');
                break;

            case 'total_harga':
                // Total harga terbesar lebih dahulu
                $reservasi->orderBy('total_harga', 'desc');
                break;

            default:
                $reservasi->orderBy('created_at', 'desc');
                break;
        }

        $reservasi = $reservasi->get();

        // Hitung sisa waktu setiap reservasi
        foreach ($reservasi as $item) {

            if (!$item->slotWaktu || !$item->tanggal) {
                $item->sisa_waktu = '-';
                continue;
            }

            $tanggal = \Carbon\Carbon::parse($item->tanggal)
                ->format('Y-m-d');

            $waktuMulai = \Carbon\Carbon::parse(
                $tanggal . ' ' . $item->slotWaktu->jam_mulai
            );

            if ($waktuMulai->isPast()) {

                $item->sisa_waktu = 'Sudah dimulai';

            } else {

                $item->sisa_waktu = now()->diffForHumans(
                    $waktuMulai,
                    [
                        'parts' => 2,
                        'short' => true,
                        'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW,
                    ]
                );
            }
        }

        return view(
            'layout.admin.reservasi.index',
            compact('reservasi')
        );
    }

    /**
     * Detail reservasi.
     */
    public function show(Reservasi $reservasi)
    {
        $reservasi->load([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu'
        ]);

        return view(
            'layout.admin.reservasi.show',
            compact('reservasi')
        );
    }


    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();

        return redirect()->route('admin.reservasi.index')->with(
            'success',
            'Reservasi berhasil dihapus.'
        );
    }


    /**
     * Menyetujui reservasi.
     */
    public function setujui(Reservasi $reservasi)
    {
        $reservasi->update([
            'status' => 'Disetujui'
        ]);

        return back()->with(
            'success',
            'Reservasi berhasil disetujui.'
        );
    }


    /**
     * Menolak reservasi.
     */
    public function tolak(Reservasi $reservasi)
    {
        $reservasi->update([
            'status' => 'Ditolak'
        ]);

        return back()->with(
            'success',
            'Reservasi berhasil ditolak.'
        );
    }
}