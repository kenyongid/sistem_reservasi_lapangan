@extends('layout.landing')

@section('title', 'Reservasi - SportSpace')

@section('content')

    <!-- breadcrumb -->
    <section class="breadcrumb-area d-flex align-items-center"
        style="background-image: url('{{ asset('template/img/slider_3_bg_img.jpg') }}');">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-xl-12">

                    <div class="breadcrumb-wrap">

                        <div class="breadcrumb-title text-center">

                            <h2>Reservasi Lapangan</h2>

                            <p>
                                Periksa status reservasi Anda dengan kode reservasi.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- breadcrumb-end -->


    <!-- booking-area -->
    <section class="booking-area pt-120 pb-120">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-9 col-md-10">

                    <div class="booking-search-box text-center">

                        <!-- ICON -->
                        <div class="booking-search-icon">

                            <i class="fas fa-calendar-check"></i>

                        </div>


                        <!-- TITLE -->
                        <div class="section-title text-center mb-30">

                            <span>CEK RESERVASI</span>

                            <h2>Cek Reservasi Anda</h2>

                            <p>
                                Masukkan kode reservasi untuk melihat
                                detail dan status pemesanan lapangan Anda.
                            </p>

                        </div>


                        <!-- SEARCH FORM -->
                        <form action="{{ route('booking.cari') }}" method="GET" class="reservation-search">

                            <div class="search-input-wrapper">

                                <input type="text" name="kode_reservasi" class="form-control"
                                    value="{{ request('kode_reservasi') }}"
                                    placeholder="Masukkan kode reservasi, contoh: RSV-3SECFVJL" autocomplete="off" required>

                                <button type="submit" class="btn">

                                    <i class="fas fa-search"></i>

                                    Cari Reservasi

                                </button>

                            </div>

                        </form>


                        <!-- ERROR -->
                        @if(session('error'))

                            <div class="reservation-alert error mt-25">

                                <i class="fas fa-exclamation-circle"></i>

                                <span>
                                    {{ session('error') }}
                                </span>

                            </div>

                        @endif


                        <!-- INFO -->
                        <div class="reservation-info mt-30">

                            <i class="fas fa-info-circle"></i>

                            <p>
                                Kode reservasi dapat ditemukan pada
                                bukti pemesanan setelah Anda melakukan reservasi.
                            </p>

                        </div>


                        <!-- BUTTON LAPANGAN -->
                        <div class="mt-30">

                            <a href="{{ route('lapangan.index') }}" class="btn reservation-book-btn">

                                <i class="fas fa-calendar-plus"></i>

                                Pesan Lapangan

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- booking-area-end -->

@endsection