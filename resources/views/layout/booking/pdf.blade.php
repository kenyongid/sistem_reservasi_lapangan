<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Bukti Reservasi {{ $reservasi->kode_reservasi }}
    </title>

    <style>
        {!! file_get_contents(public_path('template/css/style.css')) !!}
    </style>

</head>

<body>

    <div class="pdf-page">

        <div class="pdf-card">

            <!-- HEADER -->
            <div class="pdf-header">

                <div class="pdf-header-left">

                    <div class="pdf-success-icon">
                    </div>

                    <div>

                        <span class="pdf-label">
                            SPORTSPACE
                        </span>

                        <h1>
                            Reservasi Berhasil
                        </h1>

                        <p>
                            Data reservasi telah berhasil disimpan.
                        </p>

                    </div>

                </div>

            </div>


            <!-- KODE RESERVASI -->
            <div class="pdf-code-box">

                <div>

                    <span class="pdf-small-label">
                        Kode Reservasi
                    </span>

                    <div class="pdf-code">
                        {{ $reservasi->kode_reservasi }}
                    </div>

                </div>


                <div>

                    @if($reservasi->status === 'Menunggu')

                        <span class="pdf-status pdf-status-waiting">
                            Menunggu Validasi
                        </span>

                    @elseif($reservasi->status === 'Disetujui')

                        <span class="pdf-status pdf-status-approved">
                            Disetujui
                        </span>

                    @elseif($reservasi->status === 'Ditolak')

                        <span class="pdf-status pdf-status-rejected">
                            Ditolak
                        </span>

                    @else

                        <span class="pdf-status">
                            {{ $reservasi->status }}
                        </span>

                    @endif

                </div>

            </div>


            <!-- INFORMASI LAPANGAN -->
            <div class="pdf-section">

                <div class="pdf-section-title">

                    <span class="pdf-section-icon"></span>

                    Informasi Lapangan

                </div>


                <table class="pdf-detail-table">

                    <tr>

                        <td>
                            Nama Lapangan
                        </td>

                        <td>
                            {{ $reservasi->lapangan->nama ?? '-' }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Jenis Olahraga
                        </td>

                        <td>
                            {{ $reservasi->lapangan->jenisOlahraga->nama ?? '-' }}
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Harga Sewa Lapangan
                        </td>

                        <td class="pdf-price">
                            Rp {{ number_format($reservasi->lapangan->harga_per_jam ?? 0, 0, ',', '.') }}
                        </td>

                    </tr>

                </table>

            </div>


            <!-- MAKANAN & MINUMAN -->
            <div class="pdf-section">

                <div class="pdf-section-title">

                    <span class="pdf-section-icon">
                        ✚
                    </span>

                    Makanan & Minuman Tambahan

                </div>


                @if($reservasi->detailReservasi->count() > 0)

                    <table class="pdf-product-table">

                        <thead>

                            <tr>

                                <th>
                                    Produk
                                </th>

                                <th>
                                    Jumlah
                                </th>

                                <th>
                                    Subtotal
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($reservasi->detailReservasi as $detail)

                                <tr>

                                    <td>
                                        {{ $detail->produk->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $detail->jumlah }}
                                    </td>

                                    <td class="pdf-right">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="pdf-empty">
                        Tidak ada makanan atau minuman tambahan.
                    </div>

                @endif

            </div>


            <!-- TOTAL -->
            <div class="pdf-total">

                <span>
                    Total Pembayaran
                </span>

                <strong>
                    Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                </strong>

            </div>


            <!-- JADWAL + DATA PEMESAN -->
            <table class="pdf-two-column">

                <tr>

                    <!-- JADWAL -->
                    <td>

                        <div class="pdf-section-title">

                            <span class="pdf-section-icon">
                                ●
                            </span>

                            Jadwal Reservasi

                        </div>


                        <table class="pdf-detail-table">

                            <tr>

                                <td>
                                    Tanggal
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('d F Y') }}
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    Waktu
                                </td>

                                <td>

                                    @if($reservasi->slotWaktu)

                                        {{ substr($reservasi->slotWaktu->jam_mulai, 0, 5) }}
                                        -
                                        {{ substr($reservasi->slotWaktu->jam_selesai, 0, 5) }}

                                    @else

                                        -

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <td>
                                    Status
                                </td>

                                <td>
                                    {{ $reservasi->status }}
                                </td>

                            </tr>

                        </table>

                    </td>


                    <!-- DATA PEMESAN -->
                    <td>

                        <div class="pdf-section-title">

                            <span class="pdf-section-icon">
                                ●
                            </span>

                            Data Pemesan

                        </div>


                        <table class="pdf-detail-table">

                            <tr>

                                <td>
                                    Nama Lengkap
                                </td>

                                <td>
                                    {{ $reservasi->nama ?: ($reservasi->user->name ?? '-') }}
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    Email
                                </td>

                                <td>
                                    {{ $reservasi->email ?: ($reservasi->user->email ?? '-') }}
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    Nomor Telepon
                                </td>

                                <td>
                                    {{ $reservasi->telepon ?? '-' }}
                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>


            <!-- CATATAN -->
            <div class="pdf-section pdf-note-section">

                <div class="pdf-section-title">

                    <span class="pdf-section-icon">
                        ●
                    </span>

                    Catatan

                </div>


                <div class="pdf-note">

                    @if($reservasi->catatan)

                        {{ $reservasi->catatan }}

                    @else

                        Tidak ada catatan tambahan.

                    @endif

                </div>

            </div>


            <!-- INFORMASI -->
            <div class="pdf-information">

                <strong>
                    Reservasi {{ strtolower($reservasi->status) }}.
                </strong>

                <p>
                    Simpan dokumen ini sebagai bukti pemesanan Anda.
                </p>

            </div>


            <!-- FOOTER -->
            <div class="pdf-footer">

                SportSpace &bull;
                Platform Reservasi Lapangan Olahraga

                <br>

                Dokumen ini dibuat secara otomatis oleh sistem.

            </div>

        </div>

    </div>

</body>

</html>