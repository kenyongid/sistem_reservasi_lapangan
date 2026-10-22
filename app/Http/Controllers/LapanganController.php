<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\JenisOlahraga;
use App\Models\SlotWaktu;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::with('jenisOlahraga')
            ->where('status', 'aktif')
            ->get();

        $jenisOlahraga = JenisOlahraga::orderBy('nama')
            ->get();

        return view('layout.lapangan.index', compact(
            'lapangan',
            'jenisOlahraga'
        ));
    }


    public function detail(Request $request, $id)
    {
        $lapangan = Lapangan::with('jenisOlahraga')
            ->where('status', 'aktif')
            ->findOrFail($id);


        // -------------------------------------------------
        // TANGGAL YANG DIPILIH
        // -------------------------------------------------

        $tanggal = $request->tanggal ?? now()->format('Y-m-d');


        // -------------------------------------------------
        // DAFTAR SLOT WAKTU
        // Hilangkan jam yang sama/duplikat
        // -------------------------------------------------

        $slotWaktu = SlotWaktu::orderBy('jam_mulai')
            ->get()
            ->unique(function ($slot) {

                return substr($slot->jam_mulai, 0, 5)
                    . '-'
                    . substr($slot->jam_selesai, 0, 5);

            })
            ->values();


        // -------------------------------------------------
        // AMBIL RESERVASI PADA LAPANGAN + TANGGAL
        // -------------------------------------------------

        $reservasi = Reservasi::with('slotWaktu')
            ->where('lapangan_id', $lapangan->id)
            ->whereDate('tanggal', $tanggal)
            ->whereIn('status', [
                'Menunggu',
                'Disetujui'
            ])
            ->get();


        // -------------------------------------------------
        // BUAT KEY JAM YANG SUDAH TERPAKAI
        // Contoh:
        // 11:00-12:00
        // 16:00-17:00
        // -------------------------------------------------

        $slotTerpakai = $reservasi
            ->filter(function ($reservasi) {

                return $reservasi->slotWaktu;
            })
            ->map(function ($reservasi) {

                return substr(
                    $reservasi->slotWaktu->jam_mulai,
                    0,
                    5
                )
                    . '-'
                    .
                    substr(
                        $reservasi->slotWaktu->jam_selesai,
                        0,
                        5
                    );

            })
            ->unique()
            ->values()
            ->toArray();


        return view(
            'layout.lapangan.detail',
            compact(
                'lapangan',
                'tanggal',
                'slotWaktu',
                'slotTerpakai'
            )
        );
    }
}