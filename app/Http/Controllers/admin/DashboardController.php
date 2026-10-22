<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use Carbon\Carbon;
use App\Exports\WeeklyReservationExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard administrator.
     */
    public function index()
    {
        // =====================================================
        // PERIODE MINGGU BERJALAN
        // =====================================================

        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();


        // =====================================================
        // DATA LAPANGAN
        // =====================================================

        $totalLapangan = Lapangan::count();

        $lapanganAktif = Lapangan::where('status', 'aktif')->count();


        // =====================================================
        // RESERVASI MINGGU INI
        // Draft tidak dihitung karena belum menyelesaikan
        // proses pemesanan.
        // =====================================================

        $reservasiMingguIni = Reservasi::whereBetween('tanggal', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])
            ->count();


        // =====================================================
        // STATUS RESERVASI MINGGU INI
        // =====================================================

        $disetujuiMingguIni = Reservasi::whereBetween('tanggal', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])
            ->where('status', 'Disetujui')
            ->count();


        $menungguMingguIni = Reservasi::whereBetween('tanggal', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])
            ->where('status', 'Menunggu')
            ->count();


        $ditolakMingguIni = Reservasi::whereBetween('tanggal', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])
            ->where('status', 'Ditolak')
            ->count();


        // =====================================================
        // PENDAPATAN MINGGU INI
        // Hanya reservasi yang sudah disetujui.
        // =====================================================

        $pendapatanMingguIni = Reservasi::whereBetween('tanggal', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])
            ->where('status', 'Disetujui')
            ->sum('total_harga');


        // =====================================================
        // REKAP MAKANAN & MINUMAN MINGGU INI
        // =====================================================

        $pendapatanTambahanMingguIni = DetailReservasi::whereHas(
            'reservasi',
            function ($query) use ($awalMinggu, $akhirMinggu) {

                $query->whereBetween('tanggal', [
                    $awalMinggu->toDateString(),
                    $akhirMinggu->toDateString()
                ])
                    ->where('status', 'Disetujui');
            }
        )
            ->sum('subtotal');


        // =====================================================
        // PRODUK TERLARIS MINGGU INI
        // =====================================================

        $produkTerlarisMingguIni = DetailReservasi::with('produk')
            ->whereHas(
                'reservasi',
                function ($query) use ($awalMinggu, $akhirMinggu) {

                    $query->whereBetween('tanggal', [
                        $awalMinggu->toDateString(),
                        $akhirMinggu->toDateString()
                    ])
                        ->where('status', 'Disetujui');
                }
            )
            ->selectRaw(
                'produk_id,
                 SUM(jumlah) as total_terjual,
                 SUM(subtotal) as total_pendapatan'
            )
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();


        // =====================================================
        // LAPORAN RESERVASI MINGGUAN
        // =====================================================

        $laporanMingguan = collect();

        for (
            $tanggal = $awalMinggu->copy();
            $tanggal->lte($akhirMinggu);
            $tanggal->addDay()
        ) {

            $menunggu = Reservasi::whereDate(
                'tanggal',
                $tanggal->toDateString()
            )
                ->where('status', 'Menunggu')
                ->count();


            $disetujui = Reservasi::whereDate(
                'tanggal',
                $tanggal->toDateString()
            )
                ->where('status', 'Disetujui')
                ->count();


            $ditolak = Reservasi::whereDate(
                'tanggal',
                $tanggal->toDateString()
            )
                ->where('status', 'Ditolak')
                ->count();


            $laporanMingguan->push([
                'tanggal' => $tanggal->format('D'),
                'menunggu' => $menunggu,
                'disetujui' => $disetujui,
                'ditolak' => $ditolak,
            ]);
        }


        // =====================================================
        // RESERVASI TERBARU
        // Draft tidak ditampilkan.
        // =====================================================

        $reservasiTerbaru = Reservasi::with([
            'user',
            'lapangan',
            'slotWaktu'
        ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])
            ->latest()
            ->take(10)
            ->get();


        // =====================================================
        // DASHBOARD
        // =====================================================

        return view(
            'layout.admin.index',
            compact(
                'totalLapangan',
                'lapanganAktif',
                'reservasiMingguIni',
                'disetujuiMingguIni',
                'menungguMingguIni',
                'ditolakMingguIni',
                'pendapatanMingguIni',
                'pendapatanTambahanMingguIni',
                'produkTerlarisMingguIni',
                'laporanMingguan',
                'reservasiTerbaru',
                'awalMinggu',
                'akhirMinggu'
            )
        );
    }


    /**
     * Menampilkan laporan reservasi berdasarkan minggu.
     *
     * Jika parameter week tidak diberikan,
     * sistem menggunakan minggu berjalan.
     */
    public function report(Request $request)
    {
        // =====================================================
        // TENTUKAN PERIODE LAPORAN
        // =====================================================

        if ($request->filled('start_date') && $request->filled('end_date')) {

            $awalPeriode = Carbon::parse(
                $request->start_date
            )->startOfDay();

            $akhirPeriode = Carbon::parse(
                $request->end_date
            )->endOfDay();

        } elseif ($request->filled('month')) {

            $awalPeriode = Carbon::parse(
                $request->month . '-01'
            )->startOfMonth();

            $akhirPeriode = Carbon::parse(
                $request->month . '-01'
            )->endOfMonth();

        } else {

            // Default: bulan berjalan
            $awalPeriode = Carbon::now()->startOfMonth();
            $akhirPeriode = Carbon::now()->endOfMonth();
        }


        // =====================================================
        // DATA RESERVASI
        // =====================================================

        $reservasi = Reservasi::with([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu',
            'detailReservasi.produk'
        ])
            ->whereBetween('tanggal', [
                $awalPeriode->toDateString(),
                $akhirPeriode->toDateString()
            ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])
            ->orderBy('tanggal')
            ->orderBy('slot_id')
            ->get();


        // =====================================================
        // REKAP RESERVASI
        // =====================================================

        $totalReservasi = $reservasi->count();

        $totalDisetujui = $reservasi
            ->where('status', 'Disetujui')
            ->count();

        $totalMenunggu = $reservasi
            ->where('status', 'Menunggu')
            ->count();

        $totalDitolak = $reservasi
            ->where('status', 'Ditolak')
            ->count();


        // =====================================================
        // TOTAL PENDAPATAN
        // =====================================================

        $totalPendapatan = $reservasi
            ->where('status', 'Disetujui')
            ->sum('total_harga');


        // =====================================================
        // TOTAL MAKANAN & MINUMAN
        // =====================================================

        $totalPendapatanTambahan = DetailReservasi::whereHas(
            'reservasi',
            function ($query) use ($awalPeriode, $akhirPeriode) {

                $query
                    ->whereBetween('tanggal', [
                        $awalPeriode->toDateString(),
                        $akhirPeriode->toDateString()
                    ])
                    ->where('status', 'Disetujui');
            }
        )->sum('subtotal');


        // =====================================================
        // PRODUK TERLARIS
        // =====================================================

        $produkTerlaris = DetailReservasi::with('produk')
            ->whereHas(
                'reservasi',
                function ($query) use ($awalPeriode, $akhirPeriode) {

                    $query
                        ->whereBetween('tanggal', [
                            $awalPeriode->toDateString(),
                            $akhirPeriode->toDateString()
                        ])
                        ->where('status', 'Disetujui');
                }
            )
            ->selectRaw(
                'produk_id,
             SUM(jumlah) as total_terjual,
             SUM(subtotal) as total_pendapatan'
            )
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();


        // =====================================================
        // DATA FILTER UNTUK VIEW
        // =====================================================

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $month = $request->month;


        // =====================================================
        // TAMPILKAN LAPORAN
        // =====================================================

        return view(
            'layout.admin.report',
            compact(
                'reservasi',
                'awalPeriode',
                'akhirPeriode',
                'totalReservasi',
                'totalDisetujui',
                'totalMenunggu',
                'totalDitolak',
                'totalPendapatan',
                'totalPendapatanTambahan',
                'produkTerlaris',
                'startDate',
                'endDate',
                'month'
            )
        );
    }


    /**
     * Export laporan minggu terpilih ke PDF.
     */
    public function exportPdf(Request $request)
    {
        // =====================================================
        // TENTUKAN MINGGU
        // =====================================================

        if ($request->filled('week')) {

            $awalMinggu = Carbon::parse(
                $request->week
            )->startOfWeek();

        } else {

            $awalMinggu = Carbon::now()->startOfWeek();

        }

        $akhirMinggu = $awalMinggu->copy()->endOfWeek();


        // =====================================================
        // DATA RESERVASI
        // =====================================================

        $reservasi = Reservasi::with([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu',
            'detailReservasi.produk'
        ])
            ->whereBetween('tanggal', [
                $awalMinggu->toDateString(),
                $akhirMinggu->toDateString()
            ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])
            ->orderBy('tanggal')
            ->orderBy('slot_id')
            ->get();


        // =====================================================
        // GENERATE PDF
        // =====================================================

        $pdf = Pdf::loadView(
            'layout.admin.pdf',
            compact(
                'reservasi',
                'awalMinggu',
                'akhirMinggu'
            )
        );


        $pdf->setPaper(
            'a4',
            'landscape'
        );


        // =====================================================
        // DOWNLOAD
        // =====================================================

        return $pdf->download(
            'laporan-reservasi-sportspace-' .
            $awalMinggu->format('Y-m-d') .
            '.pdf'
        );
    }


    /**
     * Export laporan minggu terpilih ke CSV.
     */
    public function exportCsv(Request $request)
    {
        // =====================================================
        // TENTUKAN MINGGU
        // =====================================================

        if ($request->filled('week')) {

            $awalMinggu = Carbon::parse(
                $request->week
            )->startOfWeek();

        } else {

            $awalMinggu = Carbon::now()->startOfWeek();

        }

        $akhirMinggu = $awalMinggu->copy()->endOfWeek();


        // =====================================================
        // DATA RESERVASI
        // =====================================================

        $reservasi = Reservasi::with([
            'user',
            'lapangan.jenisOlahraga',
            'slotWaktu',
            'detailReservasi.produk'
        ])
            ->whereBetween('tanggal', [
                $awalMinggu->toDateString(),
                $akhirMinggu->toDateString()
            ])
            ->whereIn('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])
            ->orderBy('tanggal')
            ->orderBy('slot_id')
            ->get();


        // =====================================================
        // NAMA FILE
        // =====================================================

        $filename =
            'laporan-reservasi-sportspace-' .
            $awalMinggu->format('Y-m-d') .
            '.csv';


        // =====================================================
        // HEADER RESPONSE
        // =====================================================

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' =>
                'attachment; filename="' .
                $filename .
                '"',

            'Pragma' =>
                'no-cache',

            'Cache-Control' =>
                'must-revalidate, post-check=0, pre-check=0',
        ];


        // =====================================================
        // BUAT FILE CSV
        // =====================================================

        $callback = function () use ($reservasi, $awalMinggu, $akhirMinggu) {

            $file = fopen(
                'php://output',
                'w'
            );


            // UTF-8 BOM
            fprintf(
                $file,
                chr(0xEF) .
                chr(0xBB) .
                chr(0xBF)
            );


            // =================================================
            // JUDUL
            // =================================================

            fputcsv($file, [
                'LAPORAN RESERVASI SPORTSPACE'
            ]);


            fputcsv($file, [
                'Periode',
                $awalMinggu->format('d-m-Y') .
                ' s/d ' .
                $akhirMinggu->format('d-m-Y')
            ]);


            fputcsv($file, []);


            // =================================================
            // HEADER
            // =================================================

            fputcsv($file, [
                'No',
                'Kode Reservasi',
                'Pelanggan',
                'Email',
                'Nomor Telepon',
                'Lapangan',
                'Jenis Olahraga',
                'Tanggal',
                'Jam',
                'Makanan / Minuman',
                'Total Tambahan',
                'Total Harga',
                'Status'
            ]);


            // =================================================
            // DATA
            // =================================================

            foreach (
                $reservasi as $index => $item
            ) {

                // ---------------------------------------------
                // JAM
                // ---------------------------------------------

                $jam = '-';

                if ($item->slotWaktu) {

                    $jam =
                        substr(
                            $item->slotWaktu->jam_mulai,
                            0,
                            5
                        )
                        . ' - ' .
                        substr(
                            $item->slotWaktu->jam_selesai,
                            0,
                            5
                        );
                }


                // ---------------------------------------------
                // PRODUK TAMBAHAN
                // ---------------------------------------------

                $produkTambahan = [];

                $totalTambahan = 0;


                foreach (
                    $item->detailReservasi as $detail
                ) {

                    if ($detail->produk) {

                        $produkTambahan[] =
                            $detail->produk->nama .
                            ' x' .
                            $detail->jumlah;
                    }


                    $totalTambahan +=
                        $detail->subtotal ?? 0;
                }


                $daftarProduk =
                    count($produkTambahan) > 0
                    ? implode(
                        '; ',
                        $produkTambahan
                    )
                    : '-';


                // ---------------------------------------------
                // TULIS DATA
                // ---------------------------------------------

                fputcsv($file, [

                    $index + 1,

                    $item->kode_reservasi ?? '-',

                    $item->nama ?? '-',

                    $item->email ?? '-',

                    $item->telepon ?? '-',

                    $item->lapangan->nama ?? '-',

                    $item->lapangan
                        ->jenisOlahraga
                        ->nama ?? '-',

                    $item->tanggal
                    ? Carbon::parse(
                        $item->tanggal
                    )->format('d-m-Y')
                    : '-',

                    $jam,

                    $daftarProduk,

                    'Rp ' .
                    number_format(
                        $totalTambahan,
                        0,
                        ',',
                        '.'
                    ),

                    'Rp ' .
                    number_format(
                        $item->total_harga ?? 0,
                        0,
                        ',',
                        '.'
                    ),

                    $item->status ?? '-',
                ]);
            }


            // =================================================
            // REKAP
            // =================================================

            fputcsv(
                $file,
                []
            );


            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL RESERVASI',
                $reservasi->count(),
                '',
                '',
                ''
            ]);


            // =================================================
            // TOTAL MAKANAN & MINUMAN
            // =================================================

            $totalTambahanMingguIni =
                DetailReservasi::whereHas(
                    'reservasi',
                    function ($query) use ($awalMinggu, $akhirMinggu) {

                        $query
                            ->whereBetween(
                                'tanggal',
                                [
                                    $awalMinggu->toDateString(),
                                    $akhirMinggu->toDateString()
                                ]
                            )
                            ->where(
                                'status',
                                'Disetujui'
                            );
                    }
                )
                    ->sum('subtotal');


            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL MAKANAN / MINUMAN',
                '',
                'Rp ' .
                number_format(
                    $totalTambahanMingguIni,
                    0,
                    ',',
                    '.'
                ),
                '',
                ''
            ]);


            // =================================================
            // TOTAL PENDAPATAN
            // =================================================

            $totalPendapatan =
                $reservasi
                    ->where(
                        'status',
                        'Disetujui'
                    )
                    ->sum('total_harga');


            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL PENDAPATAN',
                '',
                '',
                'Rp ' .
                number_format(
                    $totalPendapatan,
                    0,
                    ',',
                    '.'
                ),
                ''
            ]);


            fclose($file);
        };


        // =====================================================
        // DOWNLOAD CSV
        // =====================================================

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }


    /**
     * Export laporan minggu terpilih ke Excel.
     */
    public function exportExcel(Request $request)
    {
        // =====================================================
        // TENTUKAN MINGGU
        // =====================================================

        if ($request->filled('week')) {

            $awalMinggu = Carbon::parse(
                $request->week
            )->startOfWeek();

        } else {

            $awalMinggu = Carbon::now()->startOfWeek();

        }


        // =====================================================
        // NAMA FILE
        // =====================================================

        $filename =
            'laporan-reservasi-sportspace-' .
            $awalMinggu->format('Y-m-d') .
            '.xlsx';


        // =====================================================
        // EXPORT EXCEL
        // =====================================================

        return Excel::download(
            new WeeklyReservationExport(
                $awalMinggu
            ),
            $filename
        );
    }
}