<!-- header -->
<header id="home" class="header-area">

    <div id="header-sticky" class="menu-area">

        <div class="container">

            <div class="second-menu">

                <div class="row align-items-center">

                    {{-- LOGO --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-6">

                        <div class="logo">

                            <a href="{{ route('home') }}" class="d-inline-flex align-items-center">

                                <img src="{{ asset('template/img/logo/lg1.png') }}" alt="SportSpace"
                                    class="sportspace-logo">

                            </a>

                        </div>

                    </div>


                    {{-- NAVIGATION --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-6">

                        <div class="responsive">

                            <i class="icon dripicons-align-right"></i>

                        </div>


                        <div class="main-menu text-center">

                            <nav id="mobile-menu">

                                <ul>

                                    <li>
                                        <a href="{{ route('home') }}">
                                            Home
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('lapangan.index') }}">
                                            Lapangan
                                        </a>
                                    </li>
                                     <li>
                                        <a href="{{ route('booking.index') }}">
                                            Riwayat pesanan
                                        </a>
                                    </li>

                                </ul>

                            </nav>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">

                        <div class="header-btn second-header-btn text-right">

                            <a href="{{ route('lapangan.index') }}" class="btn sportspace-booking-btn">

                                <i class="far fa-calendar-check"></i>

                                Pesan Sekarang

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>
<!-- header-end -->