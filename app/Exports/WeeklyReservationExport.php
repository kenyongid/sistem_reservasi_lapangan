<?php

namespace App\Exports;

use App\Models\Reservasi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WeeklyReservationExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    /**
     * =====================================================
     * DATA RESERVASI MINGGU INI
     * =====================================================
     */
    public function collection()
    {
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();

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

        return $reservasi->map(function ($item, $index) {

            /*
            |-----------------------------------------------------
            | JAM RESERVASI
            |-----------------------------------------------------
            */

            $jam = '-';

            if ($item->slotWaktu) {

                $jam =
                    substr($item->slotWaktu->jam_mulai, 0, 5)
                    . ' - ' .
                    substr($item->slotWaktu->jam_selesai, 0, 5);

            }


            /*
            |-----------------------------------------------------
            | MAKANAN & MINUMAN
            |-----------------------------------------------------
            */

            $produkTambahan = [];

            $totalTambahan = 0;

            foreach ($item->detailReservasi as $detail) {

                if ($detail->produk) {

                    $produkTambahan[] =
                        $detail->produk->nama .
                        ' x' .
                        $detail->jumlah;

                }

                $totalTambahan += $detail->subtotal ?? 0;
            }


            /*
            |-----------------------------------------------------
            | GABUNGKAN PRODUK
            |-----------------------------------------------------
            */

            $daftarProduk = count($produkTambahan) > 0
                ? implode('; ', $produkTambahan)
                : '-';


            /*
            |-----------------------------------------------------
            | DATA EXCEL
            |-----------------------------------------------------
            */

            return [

                // No
                $index + 1,

                // Kode Reservasi
                $item->kode_reservasi ?? '-',

                // Nama pelanggan
                $item->nama ?? '-',

                // Email
                $item->email ?? '-',

                // Nomor telepon
                $item->telepon ?? '-',

                // Nama lapangan
                $item->lapangan->nama ?? '-',

                // Jenis olahraga
                $item->lapangan->jenisOlahraga->nama ?? '-',

                // Tanggal
                $item->tanggal
                ? Carbon::parse($item->tanggal)->format('d-m-Y')
                : '-',

                // Jam
                $jam,

                // Makanan / Minuman
                $daftarProduk,

                // Total tambahan
                $totalTambahan,

                // Total harga
                $item->total_harga ?? 0,

                // Status
                $item->status ?? '-',

            ];
        });
    }


    /**
     * =====================================================
     * HEADER EXCEL
     * =====================================================
     */
    public function headings(): array
    {
        return [

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

            'Status',

        ];
    }


    /**
     * =====================================================
     * NAMA SHEET
     * =====================================================
     */
    public function title(): string
    {
        return 'Reservasi Mingguan';
    }


    /**
     * =====================================================
     * LEBAR KOLOM
     * =====================================================
     */
    public function columnWidths(): array
    {
        return [

            'A' => 8,

            'B' => 22,

            'C' => 25,

            'D' => 30,

            'E' => 20,

            'F' => 25,

            'G' => 18,

            'H' => 15,

            'I' => 18,

            'J' => 40,

            'K' => 18,

            'L' => 18,

            'M' => 16,

        ];
    }


    /**
     * =====================================================
     * STYLE EXCEL
     * =====================================================
     */
    public function styles(Worksheet $sheet)
    {
        /*
        |-----------------------------------------------------
        | HEADER
        |-----------------------------------------------------
        */

        $sheet->getStyle('A1:M1')->applyFromArray([

            'font' => [
                'bold' => true,

                'color' => [
                    'rgb' => 'FFFFFF'
                ],
            ],

            'fill' => [
                'fillType' => 'solid',

                'color' => [
                    'rgb' => '0D6EFD'
                ],
            ],

            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
                'wrapText' => true,
            ],

        ]);


        /*
        |-----------------------------------------------------
        | SEMUA DATA
        |-----------------------------------------------------
        */

        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle(
            'A1:M' . $highestRow
        )->applyFromArray([

                    'borders' => [

                        'allBorders' => [

                            'borderStyle' => 'thin',

                            'color' => [
                                'rgb' => 'D9D9D9'
                            ],

                        ],

                    ],

                    'alignment' => [

                        'vertical' => 'center',

                        'wrapText' => true,

                    ],

                ]);


        /*
        |-----------------------------------------------------
        | NO
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'A2:A' . $highestRow
        )->getAlignment()
            ->setHorizontal('center');


        /*
        |-----------------------------------------------------
        | TANGGAL
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'H2:H' . $highestRow
        )->getAlignment()
            ->setHorizontal('center');


        /*
        |-----------------------------------------------------
        | JAM
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'I2:I' . $highestRow
        )->getAlignment()
            ->setHorizontal('center');


        /*
        |-----------------------------------------------------
        | STATUS
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'M2:M' . $highestRow
        )->getAlignment()
            ->setHorizontal('center');


        /*
        |-----------------------------------------------------
        | TOTAL TAMBAHAN
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'K2:K' . $highestRow
        )->getNumberFormat()
            ->setFormatCode(
                '"Rp" #,##0'
            );


        /*
        |-----------------------------------------------------
        | TOTAL HARGA
        |-----------------------------------------------------
        */

        $sheet->getStyle(
            'L2:L' . $highestRow
        )->getNumberFormat()
            ->setFormatCode(
                '"Rp" #,##0'
            );


        /*
        |-----------------------------------------------------
        | TINGGI HEADER
        |-----------------------------------------------------
        */

        $sheet->getRowDimension(1)
            ->setRowHeight(30);


        /*
        |-----------------------------------------------------
        | FREEZE HEADER
        |-----------------------------------------------------
        */

        $sheet->freezePane('A2');


        /*
        |-----------------------------------------------------
        | FILTER
        |-----------------------------------------------------
        */

        $sheet->setAutoFilter(
            'A1:M' . $highestRow
        );


        return [];
    }
}