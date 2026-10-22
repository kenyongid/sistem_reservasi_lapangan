@extends('layout.landing')

@section('title', $lapangan->nama . ' - SportSpace')

@section('content')

    <!-- breadcrumb-area -->
    <section id="parallax" class="slider-area breadcrumb-area d-flex align-items-center justify-content-center fix"
        style="background-image:url('{{ asset('template/img/innerpage_bg_img.jpg') }}')">

        <div class="slider-shape ss-one layer" data-depth="0.10">
            <img src="{{ asset('template/img/doddle_6.png') }}" alt="shape">
        </div>

        <div class="slider-shape ss-three layer" data-depth="0.40">
            <img src="{{ asset('template/img/doddle_9.png') }}" alt="shape">
        </div>

        <div class="slider-shape ss-four layer" data-depth="0.60">
            <img src="{{ asset('template/img/doddle_7.png') }}" alt="shape">
        </div>


        <div class="container">

            <div class="row">

                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">

                    <div class="breadcrumb-wrap text-center">

                        <div class="breadcrumb-title mb-30">

                            <h2>Detail Lapangan</h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- breadcrumb-area-end -->


    <!-- detail-lapangan-area -->
    <section class="shop-banner-area pt-120 pb-90">

        <div class="container">

            <div class="row">


                <!-- FOTO LAPANGAN -->
                <div class="col-xl-7 col-lg-6">

                    <div class="product-details-img mb-30">

                        <div class="product-large-img">

                            <img src="{{ $lapangan->gambar
        ? asset('storage/' . $lapangan->gambar)
        : asset('template/img/shop/img4.jpg') }}" alt="{{ $lapangan->nama }}" style="
                                                width: 100%;
                                                height: 500px;
                                                object-fit: cover;
                                                border-radius: 10px;
                                            ">

                        </div>

                    </div>

                </div>


                <!-- INFORMASI LAPANGAN -->
                <div class="col-xl-5 col-lg-6">

                    <div class="product-details mb-30">


                        <!-- JENIS OLAHRAGA -->
                        <div class="product-details-title">

                            <p>
                                {{ $lapangan->jenisOlahraga->nama ?? 'Olahraga' }}
                            </p>


                            <!-- NAMA -->
                            <h1>
                                {{ $lapangan->nama }}
                            </h1>


                            <!-- HARGA -->
                            <div class="price details-price pb-30 mb-20">

                                <span>
                                    Rp
                                    {{ number_format(
        $lapangan->harga_per_jam,
        0,
        ',',
        '.'
    ) }}
                                </span>

                                <small>
                                    / jam
                                </small>

                            </div>

                        </div>


                        <!-- DESKRIPSI -->
                        <p>

                            {{ $lapangan->deskripsi ??
        'Lapangan olahraga yang dapat digunakan untuk reservasi sesuai jadwal yang tersedia.' }}

                        </p>


                        <!-- JENIS -->
                        <div class="product-cat mt-30 mb-20">

                            <span>
                                Jenis Olahraga:
                            </span>

                            <a href="#">
                                {{ $lapangan->jenisOlahraga->nama ?? '-' }}
                            </a>

                        </div>


                        <!-- STATUS -->
                        <div class="product-cat mb-30">

                            <span>
                                Status:
                            </span>

                            @if($lapangan->status === 'aktif')

                                <span class="text-success">

                                    <i class="fas fa-check-circle"></i>

                                    Tersedia

                                </span>

                            @else

                                <span class="text-danger">

                                    <i class="fas fa-times-circle"></i>

                                    Tidak Tersedia

                                </span>

                            @endif

                        </div>


                        <!-- BUTTON RESERVASI -->
                        <div class="product-details-action">

                            @if($lapangan->status === 'aktif')

                                                    <a href="{{ route(
                                    'booking.create',
                                    $lapangan->id
                                ) }}" class="btn btn-black">

                                                        <i class="far fa-calendar-check"></i>

                                                        Reservasi Sekarang

                                                    </a>

                            @else

                                <button type="button" class="btn btn-secondary" disabled>

                                    Lapangan Tidak Tersedia

                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div id="jadwal" class="mt-60">

            <div class="section-title text-center mb-40">

                <span>JADWAL</span>

                <h2>Pilih Jadwal Lapangan</h2>

                <p>
                    Pilih tanggal untuk melihat jadwal yang tersedia.
                </p>

            </div>


            {{-- PILIH TANGGAL --}}
            <form method="GET" action="{{ route('lapangan.detail', $lapangan->id) }}" class="text-center mb-40">

                <label for="tanggal" class="d-block mb-10">
                    Tanggal Reservasi
                </label>

                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" min="{{ now()->format('Y-m-d') }}"
                    onchange="this.form.submit()">

            </form>


            {{-- DAFTAR SLOT --}}
            <div class="row">

                @foreach($slotWaktu as $slot)

                    @php
                        $slotKey =
                            substr($slot->jam_mulai, 0, 5)
                            . '-'
                            .
                            substr($slot->jam_selesai, 0, 5);

                        $terpakai = in_array($slotKey, $slotTerpakai);
                    @endphp

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-20">

                        @if($terpakai)

                            {{-- SLOT SUDAH DIPESAN --}}
                            <div class="jadwal-item text-center" style="
                                                    border: 1px solid #ddd;
                                                    padding: 20px;
                                                    border-radius: 8px;
                                                    background: #f5f5f5;
                                                 ">

                                <strong>
                                    {{ substr($slot->jam_mulai, 0, 5) }}
                                    -
                                    {{ substr($slot->jam_selesai, 0, 5) }}
                                </strong>

                                <div class="mt-10 text-danger">
                                    <i class="fas fa-times-circle"></i>
                                    Sudah Dipesan
                                </div>

                            </div>

                        @else

                                    {{-- SLOT TERSEDIA --}}
                                    <a href="{{ route('booking.create', [
                                'lapangan' => $lapangan->id,
                                'tanggal' => $tanggal,
                                'slot_id' => $slot->id
                            ]) }}" class="jadwal-item text-center d-block" style="
                                                                    border: 1px solid #eee;
                                                                    padding: 20px;
                                                                    border-radius: 8px;
                                                                    background: #fff;
                                                                 ">

                                        <strong>
                                            {{ substr($slot->jam_mulai, 0, 5) }}
                                            -
                                            {{ substr($slot->jam_selesai, 0, 5) }}
                                        </strong>

                                        <div class="mt-10 text-success">
                                            <i class="fas fa-check-circle"></i>
                                            Tersedia
                                        </div>

                                    </a>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>
    </section>
    <!-- detail-lapangan-area-end -->

@endsection