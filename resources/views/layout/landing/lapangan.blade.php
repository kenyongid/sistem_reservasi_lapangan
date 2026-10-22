<!-- lapangan-area -->
<div id="lapangan" class="event fix pt-120 pb-120">

    <!-- Judul  -->
    <div class="section-t team-t paroller" data-paroller-factor="0.15" data-paroller-factor-lg="0.15"
        data-paroller-factor-md="0.15" data-paroller-factor-sm="0.15" data-paroller-type="foreground"
        data-paroller-direction="horizontal">

        <h2>Lapangan</h2>

    </div>


    <!-- Section title -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-8">

            <div class="section-title text-center mb-80">

                <span class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".2s">

                    SportSpace

                </span>

                <h2 class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".2s">

                    Lapangan & Jadwal Tersedia

                </h2>

                <p class="mt-20">
                    Pilih lapangan sesuai jenis olahraga dan periksa
                    ketersediaan jadwal sebelum melakukan reservasi.
                </p>

            </div>

        </div>

    </div>


    <div class="container">

        <div class="row">

            <div class="col-lg-12">

               {{-- FILTER LAPANGAN --}}
                <div class="nav-filter d-flex justify-content-center mb-50">

                    <nav class="lapangan-filter-nav">

                        <div class="nav nav-tabs lapangan-filter-tabs"
                            id="nav-tab"
                            role="tablist">

                            {{-- SEMUA --}}
                            <a class="nav-item nav-link active show"
                            id="nav-all-tab"
                            data-toggle="tab"
                            href="#all"
                            role="tab"
                            aria-selected="true">

                                <div class="nav-content text-center">

                                    <i class="fas fa-th-large"></i>

                                    <strong>Semua</strong>

                                    <span>Semua Lapangan</span>

                                </div>

                            </a>


                            {{-- PADEL --}}
                            <a class="nav-item nav-link"
                            id="nav-padel-tab"
                            data-toggle="tab"
                            href="#padel"
                            role="tab"
                            aria-selected="false">

                                <div class="nav-content text-center">

                                    <i class="fas fa-table-tennis"></i>

                                    <strong>Padel</strong>

                                    <span>Lapangan Padel</span>

                                </div>

                            </a>


                            {{-- MINI SOCCER --}}
                            <a class="nav-item nav-link"
                            id="nav-mini-tab"
                            data-toggle="tab"
                            href="#mini-soccer"
                            role="tab"
                            aria-selected="false">

                                <div class="nav-content text-center">

                                    <i class="fas fa-futbol"></i>

                                    <strong>Mini Soccer</strong>

                                    <span>Lapangan Mini Soccer</span>

                                </div>

                            </a>


                            {{-- BADMINTON --}}
                            <a class="nav-item nav-link"
                            id="nav-badminton-tab"
                            data-toggle="tab"
                            href="#badminton"
                            role="tab"
                            aria-selected="false">

                                <div class="nav-content text-center">

                                    <i class="fas fa-table-tennis"></i>

                                    <strong>Badminton</strong>

                                    <span>Lapangan Badminton</span>

                                </div>

                            </a>

                        </div>

                    </nav>

                </div>

                <!-- TAB CONTENT -->
                <div class="tab-content" id="nav-tabContent">


                    <!-- ====================================================== -->
                    <!-- SEMUA LAPANGAN -->
                    <!-- ====================================================== -->

                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="nav-all-tab">

                        @forelse ($lapangan as $item)

                                            <div class="row mb-30">

                                                <!-- FOTO LAPANGAN -->
                                                <div class="col-lg-3">

                                                    <div class="lapangan-photo-card">

                                                        {{-- FOTO --}}
                                                        <div class="lapangan-photo">

                                                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('template/img/event_avatar_1.png') }}" alt="{{ $item->nama }}">

                                                        </div>

                                                        {{-- INFORMASI FOTO --}}
                                                        <div class="lapangan-photo-content">

                                                            <center>
                                                                <h4>
                                                                    {{ $item->nama }}
                                                                </h4>


                                                                <span>
                                                                    <i class="fas fa-table-tennis"></i>

                                                                    {{ $item->jenisOlahraga->nama ?? 'Olahraga' }}
                                                                </span>
                                                            </center>

                                                        </div>

                                                    </div>

                                                </div>


                                                <!-- INFORMASI -->
                                                <div class="col-lg-9">

                                                    <div class="event-list-content fix">

                                                        <ul>

                                                            <li>
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                SportSpace
                                                            </li>

                                                            <li>
                                                                <i class="far fa-money-bill-alt"></i>
                                                                Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}
                                                                / jam
                                                            </li>

                                                        </ul>


                                                        <h2>
                                                            {{ $item->nama }}
                                                        </h2>


                                                        <p>
                                                            Lapangan {{ $item->jenisOlahraga->nama ?? '' }}
                                                            yang dapat digunakan untuk reservasi
                                                            sesuai jadwal yang tersedia.
                                                        </p>


                                                        <!-- STATUS -->
                                                        <div class="mt-20">

                                                            @if($item->status === 'aktif')

                                                                <span class="mr-20 text-success">

                                                                    <i class="fas fa-check-circle"></i>

                                                                    Lapangan tersedia

                                                                </span>

                                                            @else

                                                                <span class="mr-20 text-danger">

                                                                    <i class="fas fa-times-circle"></i>

                                                                    Lapangan tidak tersedia

                                                                </span>

                                                            @endif

                                                        </div>


                                                        <!-- BUTTON -->
                                                        <div class="mt-10">

                                                            <!-- LIHAT JADWAL -->
                                                            <a href="{{ route('lapangan.detail', $item->id) }}" class="btn mt-20 mr-10">

                                                                <i class="far fa-calendar-alt"></i>

                                                                Lihat Jadwal

                                                            </a>


                                                            <!-- PESAN SEKARANG -->
                                                            @if($item->status === 'aktif')

                                                                <a href="{{ route('booking.create', $item->id) }}" class="btn mt-20">

                                                                    <i class="far fa-calendar-check"></i>

                                                                    Pesan Sekarang

                                                                </a>

                                                            @endif
                                                            @php
                                                                $icons = [
                                                                    'padel' => 'fas fa-table-tennis',
                                                                    'badminton' => 'fas fa-table-tennis',
                                                                    'mini soccer' => 'fas fa-futbol',
                                                                    'soccer' => 'fas fa-futbol',
                                                                    'futsal' => 'fas fa-futbol',
                                                                    'basket' => 'fas fa-basketball-ball',
                                                                    'voli' => 'fas fa-volleyball-ball',
                                                                    'tenis' => 'fas fa-table-tennis',
                                                                ];

                                                                $jenis = strtolower($item->jenisOlahraga->nama ?? '');

                                                                $icon = $icons[$jenis] ?? 'fas fa-running';
                                                            @endphp

                                                            <div class="crical">
                                                                <i class="{{ $icon }}"></i>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                        @empty

                            <div class="text-center">

                                <p>
                                    Belum ada lapangan yang tersedia.
                                </p>

                            </div>

                        @endforelse

                    </div>



                    <!-- ====================================================== -->
                    <!-- PADEL -->
                    <!-- ====================================================== -->

                    <div class="tab-pane fade" id="padel" role="tabpanel" aria-labelledby="nav-padel-tab">

                        @forelse ($lapangan as $item)

                            @if(isset($item->jenisOlahraga) && strtolower($item->jenisOlahraga->nama) === 'padel')

                                <div class="row mb-30">

                                    <!-- FOTO -->
                                    <div class="col-lg-3">

                                        <div class="user">

                                            <div class="title">

                                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('template/img/event_avatar_1.png') }}"
                                                    alt="{{ $item->nama }}"
                                                    style="width: 100px;height: 100px;object-fit: cover;border-radius: 10px;">

                                                <h5>
                                                    {{ $item->nama }}
                                                </h5>

                                                <p>
                                                    Padel
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- INFORMASI -->
                                    <div class="col-lg-9">

                                        <div class="event-list-content fix">

                                            <ul>

                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    SportSpace
                                                </li>

                                                <li>
                                                    <i class="far fa-money-bill-alt"></i>
                                                    Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}
                                                    / jam
                                                </li>

                                            </ul>


                                            <h2>
                                                {{ $item->nama }}
                                            </h2>


                                            <p>
                                                Lapangan padel dengan jadwal
                                                yang dapat dipilih sesuai
                                                ketersediaan.
                                            </p>


                                            <!-- STATUS -->
                                            <span class="mr-20 text-success">

                                                <i class="fas fa-check-circle"></i>

                                                Lapangan tersedia

                                            </span>


                                            <!-- BUTTON -->
                                            <a href="{{ route('booking.create', $item->id) }}" class="btn mt-20">

                                                <i class="far fa-calendar-check"></i>

                                                Pesan Sekarang

                                            </a>

                                            <div class="crical">

                                                <i class="fas fa-table-tennis"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @empty

                            <div class="text-center">

                                <p>
                                    Belum ada lapangan padel.
                                </p>

                            </div>

                        @endforelse

                    </div>



                    <!-- ====================================================== -->
                    <!-- MINI SOCCER -->
                    <!-- ====================================================== -->

                    <div class="tab-pane fade" id="mini-soccer" role="tabpanel" aria-labelledby="nav-mini-tab">

                        @forelse ($lapangan as $item)

                            @if(isset($item->jenisOlahraga) && strtolower($item->jenisOlahraga->nama) === 'mini soccer')
                                <div class="row mb-30">
                                    <!-- FOTO -->
                                    <div class="col-lg-3">

                                        <div class="user">

                                            <div class="title">

                                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('template/img/event_avatar_1.png') }}"
                                                    alt="{{ $item->nama }}"
                                                    style="width: 100px;height: 100px;object-fit: cover;border-radius: 10px;">

                                                <h5>
                                                    {{ $item->nama }}
                                                </h5>

                                                <p>
                                                    Mini Soccer
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- INFORMASI -->
                                    <div class="col-lg-9">

                                        <div class="event-list-content fix">

                                            <ul>

                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    SportSpace
                                                </li>

                                                <li>
                                                    <i class="far fa-money-bill-alt"></i>
                                                    Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}
                                                    / jam
                                                </li>

                                            </ul>


                                            <h2>
                                                {{ $item->nama }}
                                            </h2>


                                            <p>
                                                Lapangan mini soccer yang dapat
                                                dipesan berdasarkan jadwal
                                                yang tersedia.
                                            </p>

                                            <!-- STATUS -->
                                            <span class="mr-20 text-success">

                                                <i class="fas fa-check-circle"></i>

                                                Lapangan tersedia

                                            </span>


                                            <!-- BUTTON -->
                                            <a href="{{ route('booking.create', $item->id) }}" class="btn mt-20">

                                                <i class="far fa-calendar-check"></i>

                                                Pesan Sekarang

                                            </a>


                                            <div class="crical">

                                                <i class="fas fa-futbol"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @empty

                            <div class="text-center">

                                <p>
                                    Belum ada lapangan mini soccer.
                                </p>

                            </div>

                        @endforelse

                    </div>



                    <!-- ====================================================== -->
                    <!-- BADMINTON -->
                    <!-- ====================================================== -->

                    <div class="tab-pane fade" id="badminton" role="tabpanel" aria-labelledby="nav-badminton-tab">

                        @forelse ($lapangan as $item)

                            @if(isset($item->jenisOlahraga) && strtolower($item->jenisOlahraga->nama) === 'badminton')
                                <div class="row mb-30">

                                    <!-- FOTO -->
                                    <div class="col-lg-3">

                                        <div class="user">

                                            <div class="title">

                                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('template/img/event_avatar_1.png') }}"
                                                    alt="{{ $item->nama }}"
                                                    style="width: 100px;height: 100px;object-fit: cover;border-radius: 10px;">

                                                <h5>
                                                    {{ $item->nama }}
                                                </h5>

                                                <p>
                                                    Badminton
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- INFORMASI -->
                                    <div class="col-lg-9">

                                        <div class="event-list-content fix">

                                            <ul>

                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    SportSpace
                                                </li>

                                                <li>
                                                    <i class="far fa-money-bill-alt"></i>
                                                    Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}
                                                    / jam
                                                </li>

                                            </ul>


                                            <h2>
                                                {{ $item->nama }}
                                            </h2>


                                            <p>
                                                Lapangan badminton yang dapat
                                                digunakan sesuai jadwal
                                                yang tersedia.
                                            </p>


                                            <!-- STATUS -->
                                            <span class="mr-20 text-success">

                                                <i class="fas fa-check-circle"></i>

                                                Lapangan tersedia

                                            </span>


                                            <!-- BUTTON -->
                                            <a href="{{ route('booking.create', $item->id) }}" class="btn mt-20">

                                                <i class="far fa-calendar-check"></i>

                                                Pesan Sekarang

                                            </a>


                                            <div class="crical">

                                                <i class="fas fa-table-tennis"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @empty

                            <div class="text-center">

                                <p>
                                    Belum ada lapangan badminton.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>


            <!-- Tombol seluruh lapangan -->
            <div class="col-lg-12 justify-content-center text-center">

                <a href="{{ url('/lapangan') }}" class="btn mt-20 mr-10">

                    Lihat Semua Lapangan
                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</div>
<!-- lapangan-area-end -->