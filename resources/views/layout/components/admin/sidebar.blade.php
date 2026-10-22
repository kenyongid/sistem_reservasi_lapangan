<!-- start sidebar -->
<aside class="sidebar-wrapper">

    <!-- Sidebar Header -->
    <div class="sidebar-header">

        <div class="logo-icon">
            <img src="{{ asset('template/admin/images/logo-icon.png') }}" class="logo-img" alt="SportSpace">
        </div>

        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">SportSpace</h5>
        </div>

        <div class="sidebar-close">
            <span class="material-symbols-outlined">
                close
            </span>
        </div>

    </div>


    <!-- Sidebar Navigation -->
    <div class="sidebar-nav" data-simplebar="true">

        <ul class="metismenu" id="menu">


            <!-- DASHBOARD -->
            <li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">

                <a href="{{ route('admin.dashboard') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            dashboard
                        </span>

                    </div>

                    <div class="menu-title">
                        Dashboard
                    </div>

                </a>

            </li>


            <!-- SPORTSPACE -->
            <li class="menu-label">
                SPORTSPACE
            </li>


            <!-- LAPANGAN -->
            <li class="{{ request()->routeIs('admin.lapangan.*') ? 'mm-active' : '' }}">

                <a href="javascript:;" class="has-arrow">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            sports
                        </span>

                    </div>

                    <div class="menu-title">
                        Lapangan
                    </div>

                </a>


                <ul>

                    <!-- DAFTAR LAPANGAN -->
                    <li>

                        <a href="{{ route('admin.lapangan.index') }}">

                            <span class="material-symbols-outlined">
                                arrow_right
                            </span>

                            Daftar Lapangan

                        </a>

                    </li>


                    <!-- TAMBAH LAPANGAN -->
                    <li>

                        <a href="{{ route('admin.lapangan.create') }}">

                            <span class="material-symbols-outlined">
                                arrow_right
                            </span>

                            Tambah Lapangan

                        </a>

                    </li>

                </ul>

            </li>

            <!-- PRODUK -->
            <li class="{{ request()->routeIs('admin.produk.*') ? 'mm-active' : '' }}">

                <a href="javascript:;" class="has-arrow">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            fastfood
                        </span>

                    </div>

                    <div class="menu-title">
                        Produk
                    </div>

                </a>


                <ul>

                    <!-- SEMUA RESERVASI -->
                    <li>

                        <a href="{{ route('admin.produk.index') }}">

                            <span class="material-symbols-outlined">
                                arrow_right
                            </span>

                            Data Produk

                        </a>

                    </li>

                </ul>

            </li>

            <!-- RESERVASI -->
            <li class="{{ request()->routeIs('admin.reservasi.*') ? 'mm-active' : '' }}">

                <a href="javascript:;" class="has-arrow">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            event_available
                        </span>

                    </div>

                    <div class="menu-title">
                        Reservasi
                    </div>

                </a>


                <ul>

                    <!-- SEMUA RESERVASI -->
                    <li>

                        <a href="{{ route('admin.reservasi.index') }}">

                            <span class="material-symbols-outlined">
                                arrow_right
                            </span>

                            Data Reservasi

                        </a>

                    </li>

                </ul>

            </li>


            <!-- LAPORAN -->
            <li class="menu-label">
                LAPORAN
            </li>


            <li>

                <a href="{{ route('admin.report') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            assessment
                        </span>

                    </div>

                    <div class="menu-title">
                        Laporan Mingguan
                    </div>

                </a>

            </li>


            <!-- DOWNLOAD CSV -->
            <li>

                <a href="{{ route('admin.report.csv') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                    </div>

                    <div class="menu-title">
                        Download CSV
                    </div>

                </a>

            </li>


            <!-- DOWNLOAD EXCEL -->
            <li>

                <a href="{{ route('admin.report.excel') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            table_view
                        </span>

                    </div>

                    <div class="menu-title">
                        Download Excel
                    </div>

                </a>

            </li>

            <!-- DOWNLOAD PDF -->
            <li>

                <a href="{{ route('admin.report.pdf') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            picture_as_pdf
                        </span>

                    </div>

                    <div class="menu-title">
                        Download PDF
                    </div>

                </a>


                <!-- SISTEM -->
            <li class="menu-label">
                SISTEM
            </li>


            <!-- WEBSITE -->
            <li>

                <a href="{{ route('home') }}">

                    <div class="parent-icon">

                        <span class="material-symbols-outlined">
                            language
                        </span>

                    </div>

                    <div class="menu-title">
                        Lihat Website
                    </div>

                </a>

            </li>


        </ul>

    </div>


    <!-- Sidebar Bottom -->
    <div class="sidebar-bottom dropdown dropup-center dropup">

        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">

            <div class="user-img">

                <img src="{{ asset('template/admin/images/avatars/01.png') }}" alt="Admin">

            </div>


            <div class="user-info">

                <h5 class="mb-0 user-name">
                    Admin SportSpace
                </h5>

                <p class="mb-0 user-designation">
                    Administrator
                </p>

            </div>

        </div>


        <ul class="dropdown-menu dropdown-menu-end">


            <!-- DASHBOARD -->
            <li>

                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">

                    <span class="material-symbols-outlined me-2">
                        dashboard
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>

            </li>


            <!-- WEBSITE -->
            <li>

                <a class="dropdown-item" href="{{ route('home') }}">

                    <span class="material-symbols-outlined me-2">
                        language
                    </span>

                    <span>
                        Lihat Website
                    </span>

                </a>

            </li>


            <li>

                <div class="dropdown-divider mb-0"></div>

            </li>


            <!-- LOGOUT -->
            <li>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="dropdown-item border-0 bg-transparent w-100 text-start">

                        <span class="material-symbols-outlined me-2">
                            logout
                        </span>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </li>


        </ul>

    </div>

</aside>
<!-- end sidebar -->