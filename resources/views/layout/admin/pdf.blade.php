<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Laporan Reservasi SportSpace
    </title>

    <style>
        {!! file_get_contents(public_path('template/css/style.css')) !!}

        
    </style>
</head>

<body>

    <div class="report-header">

        <h1>
            SPORTSPACE
        </h1>

        <h2>
            Laporan Reservasi Mingguan
        </h2>

        <p>
            Periode
            {{ $awalMinggu->translatedFormat('d F Y') }}
            -
            {{ $akhirMinggu->translatedFormat('d F Y') }}
        </p>

    </div>


    <div class="report-summary">

        <strong>
            Total Reservasi:
        </strong>

        {{ $reservasi->count() }}

    </div>


    <table class="report-table">

        <thead>

            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Lapangan</th>
                <th>Olahraga</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Total</th>
                <th>Status</th>

            </tr>

        </thead>


        <tbody>

            @forelse($reservasi as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->kode_reservasi }}
                    </td>

                    <td>
                        {{ $item->nama ?: ($item->user->name ?? '-') }}
                    </td>

                    <td>
                        {{ $item->lapangan->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->lapangan->jenisOlahraga->nama ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                    <td class="text-center">

                        @if($item->slotWaktu)

                            {{ substr($item->slotWaktu->jam_mulai, 0, 5) }}
                            -
                            {{ substr($item->slotWaktu->jam_selesai, 0, 5) }}

                        @else

                            -

                        @endif

                    </td>

                    <td class="text-right">

                        Rp
                        {{ number_format($item->total_harga, 0, ',', '.') }}

                    </td>

                    <td class="text-center">

                        {{ $item->status }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">

                        Tidak ada reservasi pada periode ini.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="report-footer">

        SportSpace - Platform Reservasi Lapangan Olahraga

        <br>

        Dokumen ini dibuat secara otomatis oleh sistem.

    </div>

</body>

</html>