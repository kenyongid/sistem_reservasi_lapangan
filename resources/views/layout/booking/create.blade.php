@extends('layout.landing')

@section('title', 'Reservasi ' . $lapangan->nama . ' - SportSpace')

@section('content')

    <!-- breadcrumb -->
    <section class="breadcrumb-area d-flex align-items-center"
        style="background-image:url('{{ asset('template/img/slider_3_bg_img.jpg') }}')">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-xl-12">

                    <div class="breadcrumb-wrap">

                        <div class="breadcrumb-title">

                            <h2>Reservasi Lapangan</h2>

                            <div class="breadcrumb-wrap">

                                <nav aria-label="breadcrumb">

                                    <ol class="breadcrumb">

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

                                        <li class="breadcrumb-item active" aria-current="page">

                                            Reservasi

                                        </li>

                                    </ol>

                                </nav>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- breadcrumb-end -->


    <!-- booking-area -->
    <section class="booking-area">

        <div class="container">

            <div class="row justify-content-center">

                <!-- INFORMASI LAPANGAN -->
                <div class="col-xl-5 col-lg-5 mb-40">

                    <div class="booking-info">

                        <span class="booking-category">
                            {{ $lapangan->jenisOlahraga->nama ?? 'Olahraga' }}
                        </span>

                        <h2>
                            {{ $lapangan->nama }}
                        </h2>

                        <div class="booking-price">

                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}

                            <small>/ jam</small>

                        </div>


                        <img src="{{ $lapangan->gambar ? asset('storage/' . $lapangan->gambar) : asset('template/img/shop/img4.jpg') }}"
                            alt="{{ $lapangan->nama }}" class="booking-image">


                        <div class="booking-summary">

                            <div>
                                <span>Jenis Olahraga</span>
                                <strong>
                                    {{ $lapangan->jenisOlahraga->nama ?? '-' }}
                                </strong>
                            </div>

                            <div>
                                <span>Status</span>

                                @if($lapangan->status === 'aktif')

                                    <strong class="text-success">
                                        Tersedia
                                    </strong>

                                @else

                                    <strong class="text-danger">
                                        Tidak Tersedia
                                    </strong>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                <!-- FORM -->
                <div class="col-xl-7 col-lg-7">

                    <div class="booking-form-card">

                        <div class="booking-heading">

                            <span>
                                SPORTSPACE
                            </span>

                            <h2>
                                Formulir Reservasi
                            </h2>

                            <p>
                                Isi data berikut untuk melakukan reservasi lapangan.
                            </p>

                        </div>


                        @if(session('error'))

                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>

                        @endif


                        @if($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form action="{{ route('booking.store') }}" method="POST">

                            @csrf

                            <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">



                            <!-- TANGGAL -->
                            <div class="booking-field">

                                <label for="tanggal">
                                    Tanggal Reservasi
                                </label>

                                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal ?? old('tanggal') }}"
                                    min="{{ date('Y-m-d') }}" required onchange="cekTanggal(this.value)">

                                <small>
                                    Pilih tanggal untuk melihat slot yang tersedia.
                                </small>

                            </div>


                            <!-- SLOT -->
                            <div class="booking-field">

                                <label class="booking-label">
                                    Slot Waktu
                                </label>

                                @if(!$tanggal)

                                    <div class="slot-message">
                                        Silakan pilih tanggal terlebih dahulu untuk melihat jadwal.
                                    </div>

                                @else

                                    <div class="row g-3">

                                        @foreach($slotWaktu as $slot)

                                            @php
                                                $slotKey = $slot->jam_mulai . '-' . $slot->jam_selesai;
                                                $terbooking = in_array($slotKey, $slotTerbooking);
                                            @endphp

                                            <div class="col-md-6">

                                                <label class="slot-card {{ $terbooking ? 'slot-disabled' : '' }}">

                                                    <div class="slot-info">

                                                        <strong>
                                                            <i class="far fa-clock"></i>

                                                            {{ substr($slot->jam_mulai, 0, 5) }}
                                                            -
                                                            {{ substr($slot->jam_selesai, 0, 5) }}
                                                        </strong>

                                                        @if($terbooking)

                                                            <span class="text-danger">
                                                                Sudah Dipesan
                                                            </span>

                                                        @else

                                                            <span class="text-success">
                                                                Tersedia
                                                            </span>

                                                        @endif

                                                    </div>


                                                    @if(!$terbooking)

                                                        <input type="radio" name="slot_id" value="{{ $slot->id }}" required>

                                                    @endif

                                                </label>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>


                            <!-- NAMA -->
                            <div class="booking-field">

                                <label for="nama">
                                    Nama Lengkap
                                </label>

                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap" required>

                            </div>


                            <!-- EMAIL -->
                            <div class="booking-field">

                                <label for="email">
                                    Email
                                </label>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Masukkan email" required>

                            </div>


                            <!-- TELEPON -->
                            <div class="booking-field">

                                <label for="telepon">
                                    Nomor Telepon
                                </label>

                                <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}"
                                    placeholder="Masukkan nomor telepon" required>

                            </div>


                            <!-- CATATAN -->
                            <div class="booking-field">

                                <label for="catatan">
                                    Catatan
                                </label>

                                <textarea id="catatan" name="catatan"
                                    placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>

                            </div>


                            <button type="submit" class="booking-submit" id="btnReservasi" {{ $lapangan->status !== 'aktif' ? 'disabled' : '' }}>

                                <i class="far fa-calendar-check"></i>

                                Konfirmasi Reservasi

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <style>
        .booking-area {
            padding: 100px 0;
            background: #f7f8fc;
        }

        .booking-info {
            background: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .07);
        }

        .booking-category {
            display: block;
            color: #ff007a;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .booking-info h2 {
            color: #0b3b91;
            font-size: 34px;
            margin-bottom: 10px;
        }

        .booking-price {
            color: #ff007a;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .booking-price small {
            color: #777;
            font-size: 13px;
        }

        .booking-image {
            width: 100%;
            height: 330px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        .booking-summary {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .booking-summary div {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .booking-summary span {
            color: #777;
        }

        .booking-summary strong {
            color: #222;
        }


        .booking-form-card {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .07);
        }

        .booking-heading {
            margin-bottom: 30px;
        }

        .booking-heading>span {
            color: #ff007a;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .booking-heading h2 {
            color: #0b3b91;
            font-size: 32px;
            margin: 8px 0;
        }

        .booking-heading p {
            color: #777;
            margin: 0;
        }


        .booking-field {
            margin-bottom: 20px;
        }

        .booking-field label {
            display: block;
            color: #222 !important;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .booking-field input,
        .booking-field select,
        .booking-field textarea {
            width: 100%;
            background: #fff !important;
            border: 1px solid #ddd !important;
            border-radius: 5px;
            color: #333 !important;
            font-size: 14px;
            padding: 13px 15px;
            outline: none;
        }

        .booking-field input,
        .booking-field select {
            height: 52px;
        }

        .booking-field textarea {
            height: 120px;
            resize: vertical;
        }

        .booking-field input:focus,
        .booking-field select:focus,
        .booking-field textarea:focus {
            border-color: #ff007a !important;
        }

        .booking-field input::placeholder,
        .booking-field textarea::placeholder {
            color: #999 !important;
        }

        .booking-field select:disabled {
            background: #f1f1f1 !important;
            color: #999 !important;
        }

        .booking-field small {
            display: block;
            margin-top: 7px;
            color: #777;
            font-size: 12px;
        }

        .booking-submit {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 5px;
            background: #ff007a;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .booking-submit:hover:not(:disabled) {
            background: #e6006d;
        }

        .booking-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        @media (max-width: 767px) {

            .booking-area {
                padding: 60px 0;
            }

            .booking-info,
            .booking-form-card {
                padding: 25px;
            }

        }

        /* ================================

                                            SportSpace - Slot Waktu
                                            ================================ */
        .slot-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .slot-card {
            display: block;
            margin: 0;
            cursor: pointer;
        }

        .slot-card input {
            display: none;
        }

        .slot-card span,
        .slot-card.disabled {
            display: block;
            padding: 15px 18px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #222;
            transition: all .2s ease;
        }

        .slot-card:hover span {
            border-color: #ff007a;
        }

        .slot-card input:checked+span {
            background: #ff007a;
            border-color: #ff007a;
            color: #fff;
        }

        .slot-time {
            font-size: 14px;
            font-weight: 600;
        }

        .slot-card small {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: #777;
        }

        .slot-card input:checked+span small {
            color: #fff;
        }

        .slot-card.disabled {
            background: #f3f3f3;
            border-color: #ddd;
            color: #999;
            cursor: not-allowed;
        }

        .slot-card.disabled small {
            color: #999;
        }

        .slot-message {
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #666;
        }

        @media (max-width: 767px) {
            .slot-grid {
                grid-template-columns: 1fr;
            }
        }

        .slot-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 18px 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: .2s;
        }

        .slot-card:hover {
            border-color: #ff007a;
        }

        .slot-card input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #ff007a;
            cursor: pointer;
        }

        .slot-card:has(input[type="radio"]:checked) {
            border-color: #ff007a;
            box-shadow: 0 0 0 1px #ff007a;
        }

        .slot-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .slot-info strong {
            color: #002691;
            font-size: 15px;
        }

        .slot-info span {
            font-size: 13px;
        }

        .slot-disabled {
            background: #f5f5f5;
            border-color: #ddd;
            cursor: not-allowed;
            opacity: .65;
        }

        .slot-disabled:hover {
            border-color: #ddd;
        }
    </style>
    <!-- booking-area-end -->
    <script>
        function cekTanggal(tanggal) {

            if (!tanggal) {
                return;
            }

            window.location.href =
                "{{ route('booking.create', $lapangan->id) }}" +
                "?tanggal=" +
                encodeURIComponent(tanggal);
        }
    </script>
@endsection