<?php

namespace App\Http\Controllers;

use App\Models\DetailReservasi;
use App\Models\Lapangan;
use App\Models\Produk;
use App\Models\Reservasi;
use App\Models\SlotWaktu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar lapangan yang dapat dipesan.
     */
    public function index()
    {
        $lapangan = Lapangan::with('jenisOlahraga')
            ->where('status', 'aktif')
            ->get();

        return view(
            'layout.booking.index',
            compact('lapangan')
        );
    }


    /**
     * Menampilkan form reservasi untuk lapangan tertentu.
     */
    public function create(Request $request, $lapangan)
    {
        // Mengambil lapangan yang masih aktif.
        $lapangan = Lapangan::with('jenisOlahraga')
            ->where('status', 'aktif')
            ->findOrFail($lapangan);
        $tanggal = $request->tanggal;

        /*
        |--------------------------------------------------------------------------
        | Mengambil daftar slot waktu
        |--------------------------------------------------------------------------
        */

        $slotWaktu = SlotWaktu::selectRaw(
            'MIN(id) as id, jam_mulai, jam_selesai'
        )
            ->where('lapangan_id', $lapangan->id)
            ->groupBy('jam_mulai', 'jam_selesai')
            ->orderBy('jam_mulai')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Mengecek slot yang sudah dipesan
        |--------------------------------------------------------------------------
        */
        $slotTerbooking = [];

        if ($tanggal) {

            $reservasi = Reservasi::with('slotWaktu')
                ->where('lapangan_id', $lapangan->id)
                ->whereDate('tanggal', $tanggal)
                ->whereIn('status', ['Draft', 'Menunggu', 'Disetujui'])
                ->get();

            foreach ($reservasi as $item) {

                if ($item->slotWaktu) {

                    $slotTerbooking[] =
                        $item->slotWaktu->jam_mulai . '-' .
                        $item->slotWaktu->jam_selesai;
                }
            }
        }

        return view(
            'layout.booking.create',
            compact(
                'lapangan',
                'slotWaktu',
                'tanggal',
                'slotTerbooking'
            )
        );
    }


    /**
     * Mengambil slot yang sudah digunakan pada tanggal tertentu.
     */
    public function slotTerpakai(Request $request, $lapangan)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        $slotTerpakai = Reservasi::where('lapangan_id', $lapangan)
            ->whereDate('tanggal', $request->tanggal)
            ->whereIn('status', ['Draft', 'Menunggu', 'Disetujui'])
            ->pluck('slot_id');

        return response()->json($slotTerpakai);
    }


    /**
     * Menampilkan halaman rekomendasi makanan dan minuman.
     */
    public function tambahan($id)
    {
        $reservasi = Reservasi::with([
            'lapangan.jenisOlahraga',
            'slotWaktu',
        ])->findOrFail($id);

        if (strcasecmp($reservasi->status, 'Draft') !== 0) {
            return redirect()->route('booking.show', $reservasi->id);
        }

        $produk = Produk::where('status', 'aktif')
            ->orderBy('kategori')
            ->orderBy('nama')
            ->get();

        return view(
            'layout.booking.tambahan',
            compact('reservasi', 'produk')
        );
    }


    /**
     * Menyimpan makanan dan minuman tambahan pada reservasi.
     */
    public function simpanTambahan(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi produk tambahan
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'produk' => 'nullable|array',
            'produk.*.id' => 'required|exists:produk,id',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Menyimpan setiap produk yang dipilih
        |--------------------------------------------------------------------------
        */

        $reservasiId = DB::transaction(function () use ($request, $id) {
            $reservasi = Reservasi::whereKey($id)->lockForUpdate()->firstOrFail();
            if (strcasecmp($reservasi->status, 'Draft') !== 0) {
                return $reservasi->id;
            }
            $totalTambahan = 0;

            if ($request->filled('produk')) {

                foreach ($request->produk as $item) {

                    // Pastikan produk masih aktif.
                    $produk = Produk::where('id', $item['id'])
                        ->where('status', 'aktif')
                        ->first();

                    if (!$produk) {
                        continue;
                    }
                    $jumlah = (int) $item['jumlah'];
                    $subtotal = $produk->harga * $jumlah;


                    DetailReservasi::create([
                        'reservasi_id' => $reservasi->id,
                        'produk_id' => $produk->id,
                        'jumlah' => $jumlah,
                        'harga' => $produk->harga,
                        'subtotal' => $subtotal,
                    ]);

                    $totalTambahan += $subtotal;
                }
            }


        /*
        |--------------------------------------------------------------------------
        | Memperbarui total harga reservasi
        |--------------------------------------------------------------------------
        */

            $reservasi->update([
                'total_harga' => $reservasi->total_harga + $totalTambahan,
                'status' => 'Menunggu',
            ]);

            return $reservasi->id;
        });


        /*
        |--------------------------------------------------------------------------
        | Menampilkan bukti reservasi
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('booking.show', $reservasiId)
            ->with(
                'success',
                'Pemesanan berhasil diselesaikan.'
            );
    }


    /**
     * Menyimpan reservasi baru.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi data reservasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'slot_id' => 'required|exists:slot_waktu,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:500',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Mengambil data lapangan
        |--------------------------------------------------------------------------
        */

        $reservasi = DB::transaction(function () use ($validated) {
            $lapangan = Lapangan::whereKey($validated['lapangan_id'])
                ->lockForUpdate()
                ->firstOrFail();
            $slot = SlotWaktu::whereKey($validated['slot_id'])
                ->where('lapangan_id', $lapangan->id)
                ->firstOrFail();

            abort_if($slot->jam_selesai <= $slot->jam_mulai, 422, 'Rentang waktu slot tidak valid.');

            $sudahDipesan = Reservasi::where('lapangan_id', $lapangan->id)
                ->whereDate('tanggal', $validated['tanggal'])
                ->whereIn('status', ['Draft', 'Menunggu', 'Disetujui'])
                ->whereHas('slotWaktu', function ($query) use ($slot) {
                    $query->where('jam_mulai', '<', $slot->jam_selesai)
                        ->where('jam_selesai', '>', $slot->jam_mulai);
                })
                ->exists();

            if ($sudahDipesan) {
                return null;
            }

            return Reservasi::create([
                'kode_reservasi' => 'RSV-' . strtoupper(Str::random(8)),
                'user_id' => auth()->id(),
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'catatan' => $validated['catatan'] ?? null,
                'lapangan_id' => $lapangan->id,
                'slot_id' => $slot->id,
                'tanggal' => $validated['tanggal'],
                'total_harga' => $lapangan->harga_per_jam,
                'status' => 'Draft',
            ]);
        });

        if (!$reservasi) {
            return back()->withInput()->with('error', 'Slot waktu tersebut sudah dipesan. Silakan pilih slot lain.');
        }


        /*
        |--------------------------------------------------------------------------
        | Mengarahkan ke halaman tambahan
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'booking.tambahan',
                $reservasi->id
            )
            ->with(
                'success',
                'Reservasi berhasil dibuat. Silakan pilih makanan atau minuman tambahan.'
            );
    }


    /**
     * Mencari reservasi berdasarkan kode reservasi.
     */
    public function cari(Request $request)
    {
        $request->validate([
            'kode_reservasi' => 'required|string',
        ]);

        $kodeReservasi = strtoupper(
            trim($request->kode_reservasi)
        );

        $reservasi = Reservasi::where(
            'kode_reservasi',
            $kodeReservasi
        )->first();


        if (!$reservasi) {

            return back()->with('error', 'Kode reservasi tidak ditemukan.');
        }


        return redirect()
            ->route('booking.show', $reservasi->id);
    }

    /**
     * Menampilkan bukti reservasi.
     */
    public function show($id)
    {
        $reservasi = Reservasi::with([
            'lapangan.jenisOlahraga',
            'slotWaktu',
            'detailReservasi.produk',
        ])->findOrFail($id);

        return view(
            'layout.booking.show',
            compact('reservasi')
        );
    }


    /**
     * Membuat dan mengunduh bukti reservasi dalam format PDF.
     */
    public function downloadPdf($id)
    {
        $reservasi = Reservasi::with([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu',
            'detailReservasi.produk',
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'layout.booking.pdf',
            compact('reservasi')
        );

        $pdf->setPaper(
            'a4',
            'portrait'
        );

        return $pdf->download(
            'bukti-reservasi-' .
            $reservasi->kode_reservasi .
            '.pdf'
        );
    }
}
