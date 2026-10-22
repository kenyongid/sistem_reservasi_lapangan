<!-- slider-area -->
<section id="parallax"
    class="slider-area slider-bg second-slider-bg slider-bg3 d-flex align-items-center justify-content-center fix"
    style="background-image:url('{{ asset('template/img/slider_3_bg_img.jpg') }}')">

    <div class="slider-shape ss-one layer" data-depth="0.10">
        <img src="{{ asset('template/img/doddle_6.png') }}" alt="shape">
    </div>

    <div class="slider-shape ss-three layer" data-depth="0.40">
        <img src="{{ asset('template/img/doddle_9.png') }}" alt="shape">
    </div>

    <div class="slider-shape ss-four layer" data-depth="0.60">
        <img src="{{ asset('template/img/doddle_7.png') }}" alt="shape">
    </div>

    <div class="slider-active">

        <div class="single-slider">

            <div class="container">

                <div class="row">

                    <!-- Konten utama -->
                    <div class="col-lg-8 col-sm-12">

                        <div class="slider-content second-slider-content">

                            <ul data-animation="fadeInUp animated" data-delay=".2s">

                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    SportSpace
                                </li>

                                <li>
                                    <i class="far fa-clock"></i>
                                    Setiap Hari
                                </li>

                                <li>
                                    <i class="fal fa-building"></i>
                                    Pusat Reservasi Lapangan
                                </li>

                            </ul>

                            <h2 data-animation="fadeInUp animated" data-delay=".4s">
                                Reservasi Lapangan Olahraga dengan Mudah
                            </h2>

                            <div class="conterdown wow fadeInDown animated" data-animation="fadeInDown animated"
                                data-delay=".2s">

                                <div class="timer">

                                    <div class="timer-outer bdr1">
                                        <span class="days" data-days>24</span>
                                        <div class="smalltext">Jam</div>
                                        <div class="value-bar"></div>
                                    </div>

                                    <div class="timer-outer bdr2">
                                        <span class="hours" data-hours>7</span>
                                        <div class="smalltext">Hari</div>
                                    </div>

                                    <div class="timer-outer bdr3">
                                        <span class="minutes" data-minutes>3</span>
                                        <div class="smalltext">Olahraga</div>
                                    </div>

                                    <div class="timer-outer bdr4">
                                        <span class="seconds" data-seconds>24</span>
                                        <div class="smalltext">Slot</div>
                                    </div>

                                    <p id="time-up"></p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Fasilitas -->
                    <div class="col-lg-4 col-sm-12">

                        <div class="booking-form mt-200 align-items-center justify-content-center wow fadeInLeft"
                            data-animation="fadeInLeft" data-delay=".2s">

                            <h2>Lapangan Olahraga</h2>

                            <div class="slider-img text-center">

                                <div id="lapanganCarousel" class="carousel slide" data-ride="carousel">

                                    <!-- INDICATOR -->
                                    <ol class="carousel-indicators">

                                        <li data-target="#lapanganCarousel" data-slide-to="0" class="active">
                                        </li>

                                        <li data-target="#lapanganCarousel" data-slide-to="1">
                                        </li>

                                        <li data-target="#lapanganCarousel" data-slide-to="2">
                                        </li>

                                        <li data-target="#lapanganCarousel" data-slide-to="3">
                                        </li>

                                    </ol>


                                    <!-- GAMBAR -->
                                    <div class="carousel-inner">

                                        <!-- FOTO 1 -->
                                        <div class="carousel-item active">

                                            <img src="{{ asset('template/img/padel/pd1.jpg') }}" class="d-block w-100"
                                                alt="Lapangan Padel">

                                        </div>


                                        <!-- FOTO 2 -->
                                        <div class="carousel-item">

                                            <img src="{{ asset('template/img/padel/pd2.jpg') }}" class="d-block w-100"
                                                alt="Lapangan Padel">

                                        </div>


                                        <!-- FOTO 3 -->
                                        <div class="carousel-item">

                                            <img src="{{ asset('template/img/soccer/ms3.jpg') }}" class="d-block w-100"
                                                alt="Lapangan Soccer">

                                        </div>


                                        <!-- FOTO 4 -->
                                        <div class="carousel-item">

                                            <img src="{{ asset('template/img/badminton/bd1.jpg') }}" class="d-block w-100"
                                                alt="Lapangan Badminton">

                                        </div>

                                    </div>


                                    <!-- PREVIOUS -->
                                    <a class="carousel-control-prev" href="#lapanganCarousel" role="button"
                                        data-slide="prev">

                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                        </span>

                                        <span class="sr-only">
                                            Sebelumnya
                                        </span>

                                    </a>


                                    <!-- NEXT -->
                                    <a class="carousel-control-next" href="#lapanganCarousel" role="button"
                                        data-slide="next">

                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                        </span>

                                        <span class="sr-only">
                                            Berikutnya
                                        </span>

                                    </a>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- slider-area-end -->