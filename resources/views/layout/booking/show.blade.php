@extends('layout.landing')

@section('title', 'Bukti Reservasi - SportSpace')

@section('content')

    <!-- Breadcrumb -->
    <section class="slider-area breadcrumb-area d-flex align-items-center justify-content-center fix"
        style="background-image:url('{{ asset('template/img/innerpage_bg_img.jpg') }}')">

        <div class="container">

            <div class="row">

                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">

                    <div class="breadcrumb-wrap text-center">

                        <div class="breadcrumb-title mb-20">

                            <h2>Bukti Reservasi</h2>

                        </div>

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb justify-content-center">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        Beranda
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('lapangan.index') }}">
                                        Lapangan
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">
                                    Bukti Reservasi
                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Booking Confirmation -->
    <section class="booking-result-area">

        <div class="container">

            @if(session('success'))

                <div class="booking-alert">

                    <i class="fas fa-check-circle"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            <div class="booking-result-card">

                <!-- Header -->
                <div class="booking-result-header">

                    <div class="success-icon">

                        <i class="fas fa-check"></i>

                    </div>

                    <div>

                        <span class="result-label">
                            SPORTSPACE
                        </span>

                        <h2>
                            Reservasi Berhasil
                        </h2>

                        <p>
                            Data reservasi telah berhasil disimpan.
                        </p>

                    </div>

                </div>


                <!-- Kode Reservasi -->
                <div class="reservation-code-box">

                    <div>

                        <span>
                            Kode Reservasi
                        </span>

                        <h3>
                            {{ $reservasi->kode_reservasi }}
                        </h3>

                    </div>


                    <div>

                        @if($reservasi->status === 'Menunggu')

                            <span class="reservation-status status-waiting">
                                Menunggu Validasi
                            </span>

                        @elseif($reservasi->status === 'Disetujui')

                            <span class="reservation-status status-approved">
                                Disetujui
                            </span>

                        @elseif($reservasi->status === 'Ditolak')

                            <span class="reservation-status status-rejected">
                                Ditolak
                            </span>

                        @else

                            <span class="reservation-status">
                                {{ $reservasi->status }}
                            </span>

                        @endif

                    </div>

                </div>

                <!-- Isi -->
                <div class="booking-result-body">

                    <!-- Informasi Lapangan -->
                    <div class="result-section result-section-full">

                        <div class="result-section-title">
                            <i class="fas fa-map-marker-alt"></i>

                            <h4>
                                Informasi Lapangan
                            </h4>
                        </div>

                        <div class="result-item">
                            <span>
                                Nama Lapangan
                            </span>

                            <strong>
                                {{ $reservasi->lapangan->nama ?? '-' }}
                            </strong>
                        </div>

                        <div class="result-item">
                            <span>
                                Jenis Olahraga
                            </span>

                            <strong>
                                {{ $reservasi->lapangan->jenisOlahraga->nama ?? '-' }}
                            </strong>
                        </div>

                        <div class="result-item">
                            <span>
                                Harga Sewa Lapangan
                            </span>

                            <strong class="price-text">
                                Rp {{ number_format($reservasi->lapangan->harga_per_jam ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>

                    </div>


                    <!-- Makanan & Minuman -->
                    <div class="result-section result-section-full">

                        <div class="result-section-title">
                            <i class="fas fa-utensils"></i>

                            <h4>
                                Makanan & Minuman Tambahan
                            </h4>
                        </div>

                        @if($reservasi->detailReservasi->count() > 0)

                            @foreach($reservasi->detailReservasi as $detail)

                                <div class="result-item">

                                    <span>
                                        {{ $detail->produk->nama ?? '-' }}
                                        × {{ $detail->jumlah }}
                                    </span>

                                    <strong>
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </strong>

                                </div>

                            @endforeach

                        @else

                            <div class="result-note no-extra">
                                Tidak ada makanan atau minuman tambahan.
                            </div>

                        @endif

                    </div>


                    <!-- Total Pembayaran -->
                    <div class="reservation-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>
                            Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                        </strong>

                    </div>


                    <!-- Jadwal & Data Pemesan -->
                    <div class="row">

                        <!-- Jadwal Reservasi -->
                        <div class="col-lg-6">

                            <div class="result-section">

                                <div class="result-section-title">
                                    <i class="far fa-calendar-alt"></i>

                                    <h4>
                                        Jadwal Reservasi
                                    </h4>
                                </div>

                                <div class="result-item">

                                    <span>
                                        Tanggal
                                    </span>

                                    <strong>
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('d F Y') }}
                                    </strong>

                                </div>

                                <div class="result-item">

                                    <span>
                                        Waktu
                                    </span>

                                    <strong>

                                        @if($reservasi->slotWaktu)

                                            {{ \Carbon\Carbon::parse($reservasi->slotWaktu->jam_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($reservasi->slotWaktu->jam_selesai)->format('H:i') }}

                                        @else

                                            -

                                        @endif

                                    </strong>

                                </div>

                                <div class="result-item">

                                    <span>
                                        Status
                                    </span>

                                    <strong>
                                        {{ $reservasi->status }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <!-- Data Pemesan -->
                        <div class="col-lg-6">

                            <div class="result-section">

                                <div class="result-section-title">
                                    <i class="fas fa-user"></i>

                                    <h4>
                                        Data Pemesan
                                    </h4>
                                </div>

                                <div class="result-item">

                                    <span>
                                        Nama Lengkap
                                    </span>

                                    <strong>
                                        {{ $reservasi->nama ?? '-' }}
                                    </strong>

                                </div>

                                <div class="result-item">

                                    <span>
                                        Email
                                    </span>

                                    <strong>
                                        {{ $reservasi->email ?? '-' }}
                                    </strong>

                                </div>

                                <div class="result-item">

                                    <span>
                                        Nomor Telepon
                                    </span>

                                    <strong>
                                        {{ $reservasi->telepon ?? '-' }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Catatan -->
                    <div class="result-section result-section-full">

                        <div class="result-section-title">
                            <i class="far fa-sticky-note"></i>

                            <h4>
                                Catatan
                            </h4>

                        </div>

                        <div class="result-note">

                            @if($reservasi->catatan)

                                {{ $reservasi->catatan }}

                            @else

                                Tidak ada catatan tambahan.

                            @endif

                        </div>

                    </div>

                </div>


                <!-- Informasi -->
                <div class="reservation-info">

                    <i class="fas fa-info-circle"></i>

                    <div>

                        @if($reservasi->status === 'Menunggu')

                            <strong>
                                Reservasi menunggu validasi admin.
                            </strong>

                            <p>
                                Simpan kode reservasi ini sebagai bukti
                                pemesanan Anda.
                            </p>

                        @elseif($reservasi->status === 'Disetujui')

                            <strong>
                                Reservasi telah disetujui.
                            </strong>

                            <p>
                                Silakan datang sesuai tanggal dan waktu
                                reservasi.
                            </p>

                        @elseif($reservasi->status === 'Ditolak')

                            <strong>
                                Reservasi ditolak.
                            </strong>

                            <p>
                                Silakan pilih lapangan atau jadwal lainnya.
                            </p>

                        @endif

                    </div>

                </div>


                <!-- Tombol -->
                <div class="booking-result-actions">

                    <a href="{{ route('booking.pdf', $reservasi->id) }}" class="btn">
                        <i class="fas fa-file-pdf"></i>
                        Download Bukti PDF
                    </a>

                    <a href="{{ route('lapangan.index') }}" class="result-btn">

                        <i class="fas fa-th-large"></i>

                        Pilih Lapangan Lain

                    </a>


                    <a href="{{ route('home') }}" class="result-btn result-btn-outline">

                        <i class="fas fa-home"></i>

                        Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>

    </section>




@endsection