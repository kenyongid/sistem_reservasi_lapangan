@extends('layout.landing')

@section('title', 'Daftar Lapangan - SportSpace')

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
                            <h2>Daftar Lapangan</h2>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>
    <!-- breadcrumb-area-end -->


    <!-- lapangan-area -->
    <section id="lapangan" class="shop-area pt-120 pb-120 p-relative">

        <div class="container">

            <!-- Header -->
            <div class="row align-items-center mb-50">

                <div class="col-lg-6 col-sm-12">

                    <div class="section-title">

                        <span>
                            SportSpace
                        </span>

                        <h2>
                            Pilih Lapangan
                        </h2>

                        <p class="mt-15">
                            Pilih lapangan berdasarkan jenis olahraga
                            dan lihat jadwal yang tersedia sebelum
                            melakukan reservasi.
                        </p>

                    </div>

                </div>


                <!-- Filter -->
                <div class="col-lg-6 col-sm-12 text-right">

                    <select id="filterOlahraga" class="orderby" aria-label="Filter jenis olahraga">

                        <option value="semua">
                            Semua Olahraga
                        </option>

                        @foreach ($jenisOlahraga as $jenis)

                            <option value="{{ $jenis->nama }}">
                                {{ $jenis->nama }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <!-- Daftar Lapangan -->
            <div class="row" id="daftarLapangan">

                @forelse ($lapangan as $item)

                    <div class="col-lg-4 col-md-6 lapangan-item" data-olahraga="{{ $item->jenisOlahraga->nama ?? '' }}">

                        <div class="product mb-40">

                            <!-- Gambar Lapangan -->
                            <div class="product__img">

                                <a href="{{ route('lapangan.detail', $item->id) }}">

                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('template/img/shop/img4.jpg') }}"
                                        alt="{{ $item->nama }}">
                                </a>

                                <!-- Action saat hover -->
                                <div class="product-action text-center">

                                    <a href="{{ route('lapangan.detail', $item->id) }}">
                                        Lihat Jadwal
                                    </a>

                                </div>

                            </div>


                            <!-- Informasi Lapangan -->
                            <div class="product__content text-center pt-30">

                                <!-- Jenis Olahraga -->
                                <span class="pro-cat">

                                    {{ $item->jenisOlahraga->nama ?? 'Olahraga' }}

                                </span>


                                <!-- Nama Lapangan -->
                                <h4 class="pro-title">

                                    <a href="{{ route('lapangan.detail', $item->id) }}">

                                        {{ $item->nama }}

                                    </a>

                                </h4>


                                <!-- Harga -->
                                <div class="price">

                                    <span>

                                        Rp
                                        {{ number_format($item->harga_per_jam, 0, ',', '.') }}

                                        / jam

                                    </span>

                                </div>


                                <!-- Status -->
                                <div class="mt-10">

                                    @if ($item->status === 'aktif')

                                        <span class="text-success">

                                            <i class="fas fa-check-circle"></i>

                                            Tersedia

                                        </span>

                                    @else

                                        <span class="text-danger">

                                            <i class="fas fa-times-circle"></i>

                                            Tidak tersedia

                                        </span>

                                    @endif

                                </div>


                                <!-- Tombol -->
                                <div class="mt-15">

                                    <a href="{{ route('lapangan.detail', $item->id) }}" class="btn">

                                        <i class="far fa-calendar-check"></i>

                                        Lihat Jadwal

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center">

                        <p>
                            Belum ada lapangan yang tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>
    <!-- lapangan-area-end -->


    <!-- Filter JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const filter = document.getElementById('filterOlahraga');

            const items = document.querySelectorAll('.lapangan-item');


            console.log('Filter:', filter);

            console.log('Jumlah lapangan:', items.length);


            if (!filter) {

                console.error('Element #filterOlahraga tidak ditemukan.');

                return;

            }


            filter.addEventListener('change', function () {

                const pilihan = this.value
                    .trim()
                    .toLowerCase();


                items.forEach(function (item) {

                    const jenis = (
                        item.getAttribute('data-olahraga') || ''
                    )
                        .trim()
                        .toLowerCase();


                    if (
                        pilihan === 'semua' ||
                        jenis === pilihan
                    ) {

                        item.style.display = '';

                    } else {

                        item.style.display = 'none';

                    }

                });

            });

        });
    </script>

@endsection