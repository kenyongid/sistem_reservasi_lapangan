<!-- counter-area -->
<div class="counter-area pt-120 pb-120"
    style="background-image:url('{{ asset('template/img/counter_bg.jpg') }}');background-size: cover;">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-sm-6">

                <div class="about-title second-atitle">

                    <span class="wow fadeInUp animated"
                        data-animation="fadeInUp animated"
                        data-delay=".2s">

                        Mengapa SportSpace?

                    </span>

                    <h2 class="wow fadeInUp animated"
                        data-animation="fadeInUp animated"
                        data-delay=".2s">

                        Semua Kebutuhan Reservasi dalam Satu Sistem

                    </h2>

                    <h5 class="wow fadeInUp animated"
                        data-animation="fadeInUp animated"
                        data-delay=".2s">

                        Pilih olahraga, lapangan, tanggal, dan waktu dengan lebih mudah.

                    </h5>

                </div>

                <ul class="wow fadeInDown animated"
                    data-animation="fadeInDown animated"
                    data-delay=".2s">

                    <li>
                        <img src="{{ asset('template/img/calendar.png') }}" alt="Jadwal">

                        <span>
                            Pengguna dapat memilih tanggal dan slot waktu
                            berdasarkan jadwal lapangan yang tersedia.
                        </span>
                    </li>

                    <li>
                        <img src="{{ asset('template/img/comments.png') }}" alt="Reservasi">

                        <span>
                            Setiap reservasi memiliki status sehingga pengguna
                            dapat mengetahui perkembangan pesanannya.
                        </span>
                    </li>

                </ul>

            </div>


            <div class="col-lg-6 col-sm-6">

                <div class="single-counter text-center mb-30 cr1">

                    <div class="counter p-relative">

                        <span class="count">
                            {{ $jenisOlahraga }}
                        </span>

                        <small>+</small>

                    </div>

                    <p>Jenis Olahraga</p>

                </div>


                <div class="single-counter text-center mb-30 cr2">

                    <div class="counter p-relative">

                        <span class="count">
                            {{ $jumlahLapangan }}
                        </span>

                        <small>+</small>

                    </div>

                    <p>Lapangan Aktif</p>

                </div>


                <div class="single-counter text-center mb-30 cr3">

                    <div class="counter p-relative">

                        <span class="count">
                            {{ $jumlahReservasi }}
                        </span>

                        <small>+</small>

                    </div>

                    <p>Reservasi</p>

                </div>


                <div class="cr4"></div>
                <div class="cr5"></div>
                <div class="cr6"></div>

            </div>

        </div>

    </div>

</div>
<!-- counter-area-end -->