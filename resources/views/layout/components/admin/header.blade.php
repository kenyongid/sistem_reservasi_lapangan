<!-- start header -->
<header class="top-header">

    <nav class="navbar navbar-expand justify-content-between">

        <!-- Toggle Sidebar -->
        <div class="btn-toggle-menu">
            <span class="material-symbols-outlined">
                menu
            </span>
        </div>


        <!-- Search Reservasi -->
        <form action="{{ route('admin.reservasi.index') }}" method="GET"
            class="position-relative search-bar d-lg-block d-none">

            <input class="form-control form-control-sm rounded-5 px-5" type="search" name="search"
                value="{{ request('search') }}" placeholder="Cari reservasi...">

            <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50">
                search
            </span>

        </form>


        <!-- Right Menu -->
        <ul class="navbar-nav top-right-menu gap-2">


            <!-- Search Mobile -->
            <li class="nav-item d-lg-none d-block" data-bs-toggle="modal" data-bs-target="#searchModal">

                <a class="nav-link" href="javascript:;">

                    <span class="material-symbols-outlined">
                        search
                    </span>

                </a>

            </li>


            <!-- Notifikasi Reservasi -->
            <li class="nav-item dropdown dropdown-large">

                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                    data-bs-toggle="dropdown">

                    <div class="position-relative">

                        @if($jumlahReservasiMenunggu > 0)

                            <span class="notify-badge">
                                {{ $jumlahReservasiMenunggu }}
                            </span>

                        @endif

                        <span class="material-symbols-outlined">
                            notifications_none
                        </span>

                    </div>

                </a>


                <div class="dropdown-menu dropdown-menu-end mt-lg-2">


                    <!-- Header -->
                    <a href="{{ route('admin.reservasi.index') }}">

                        <div class="msg-header">

                            <p class="msg-header-title">
                                Notifikasi
                            </p>

                            <p class="msg-header-clear ms-auto">
                                Reservasi
                            </p>

                        </div>

                    </a>


                    <!-- Notification List -->
                    <div class="header-notifications-list">

                        @if($jumlahReservasiMenunggu > 0)

                            @foreach($reservasiMenungguTerbaru as $reservasi)
                                <a class="dropdown-item" href="{{ route('admin.reservasi.show', $reservasi) }}">
                                    <div class="d-flex align-items-center">
                                        <div class="notify text-warning border">
                                            <span class="material-symbols-outlined">event_available</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name mb-1">Pesanan {{ $reservasi->kode_reservasi }}</h6>
                                            <p class="msg-info mb-0">
                                                {{ $reservasi->nama }} · {{ $reservasi->lapangan->nama ?? 'Lapangan' }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        @else

                            <!-- Tidak Ada Reservasi -->
                            <a class="dropdown-item" href="{{ route('admin.reservasi.index') }}">

                                <div class="d-flex align-items-center">

                                    <div class="notify text-success border">

                                        <span class="material-symbols-outlined">
                                            check_circle
                                        </span>

                                    </div>


                                    <div class="flex-grow-1">

                                        <h6 class="msg-name mb-1">
                                            Tidak Ada Reservasi Baru
                                        </h6>

                                        <p class="msg-info mb-0">
                                            Semua reservasi sudah ditangani.
                                        </p>

                                    </div>

                                </div>

                            </a>

                        @endif

                    </div>


                    <!-- Footer -->
                    <a href="{{ route('admin.reservasi.index') }}">

                        <div class="text-center msg-footer">
                            Lihat Data Reservasi
                        </div>

                    </a>

                </div>

            </li>


        </ul>

    </nav>

</header>
<!-- end header -->
