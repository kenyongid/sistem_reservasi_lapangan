@extends('layout.admin')

@section('title', 'Dashboard Admin - SportSpace')

@section('content')

    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4">

        {{-- Total Lapangan --}}
        <div class="col">
            <div class="card radius-10 border-0 border-start border-primary border-4">
                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div>
                            <p class="mb-1">Total Lapangan</p>

                            <h4 class="mb-0 text-primary">
                                {{ $totalLapangan }}
                            </h4>
                        </div>

                        <div class="ms-auto widget-icon bg-primary text-white">
                            <i class="bi bi-grid-fill"></i>
                        </div>

                    </div>

                    <small class="text-muted">
                        {{ $lapanganAktif }} lapangan aktif
                    </small>

                </div>
            </div>
        </div>


        {{-- Reservasi Minggu Ini --}}
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-4">
                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div>
                            <p class="mb-1">Reservasi Minggu Ini</p>

                            <h4 class="mb-0 text-success">
                                {{ $reservasiMingguIni }}
                            </h4>
                        </div>

                        <div class="ms-auto widget-icon bg-success text-white">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>

                    </div>

                    <small class="text-muted">
                        {{ $awalMinggu->format('d M') }}
                        -
                        {{ $akhirMinggu->format('d M Y') }}
                    </small>

                </div>
            </div>
        </div>


        {{-- Menunggu --}}
        <div class="col">
            <div class="card radius-10 border-0 border-start border-warning border-4">
                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div>
                            <p class="mb-1">Menunggu Persetujuan</p>

                            <h4 class="mb-0 text-warning">
                                {{ $reservasiMenungguTotal }}
                            </h4>
                        </div>

                        <div class="ms-auto widget-icon bg-warning text-dark">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                    </div>

                    <small class="text-muted">
                        <a href="{{ route('admin.reservasi.index') }}" class="text-reset">
                            Perlu ditinjau admin
                        </a>
                    </small>

                </div>
            </div>
        </div>


        {{-- Pendapatan --}}
        <div class="col">
            <div class="card radius-10 border-0 border-start border-danger border-4">
                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div>
                            <p class="mb-1">Pendapatan Minggu Ini</p>

                            <h4 class="mb-0 text-danger">
                                Rp {{ number_format($pendapatanMingguIni, 0, ',', '.') }}
                            </h4>
                        </div>

                        <div class="ms-auto widget-icon bg-danger text-white">
                            <i class="bi bi-cash-stack"></i>
                        </div>

                    </div>

                    <small class="text-muted">
                        Hanya reservasi disetujui
                    </small>

                </div>
            </div>
        </div>

    </div>


    {{-- ========================= --}}
    {{-- LAPORAN MINGGUAN --}}
    {{-- ========================= --}}

    <div class="row mt-4">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header bg-transparent">

                    <div class="d-flex align-items-center">

                        <div>
                            <h6 class="mb-0 fw-bold">
                                Laporan Reservasi Mingguan
                            </h6>

                            <small class="text-muted">
                                {{ $awalMinggu->format('d M Y') }}
                                -
                                {{ $akhirMinggu->format('d M Y') }}
                            </small>
                        </div>

                        <div class="ms-auto">

                            <a href="{{ route('admin.report.csv') }}" class="btn btn-sm btn-outline-success">

                                <i class="bi bi-filetype-csv"></i>
                                CSV

                            </a>

                            <a href="{{ route('admin.report.excel') }}" class="btn btn-sm btn-outline-primary">

                                <i class="bi bi-file-earmark-excel"></i>
                                Excel

                            </a>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div id="weeklyReservationChart"></div>

                </div>

            </div>

        </div>


        {{-- Statistik --}}
        <div class="col-lg-4">

            <div class="card">

                <div class="card-header bg-transparent">

                    <h6 class="mb-0 fw-bold">
                        Status Reservasi Minggu Ini
                    </h6>

                </div>

                <div class="card-body">

                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            {{ $reservasiMingguIni }}
                        </h2>

                        <p class="text-muted mb-0">
                            Total Reservasi
                        </p>

                    </div>


                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Disetujui</span>

                            <span class="badge bg-success rounded-pill">
                                {{ $disetujuiMingguIni }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Menunggu</span>

                            <span class="badge bg-warning rounded-pill">
                                {{ $menungguMingguIni }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Ditolak</span>

                            <span class="badge bg-danger rounded-pill">
                                {{ $ditolakMingguIni }}
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>
    <div class="row">

        <!-- Pendapatan Tambahan -->
        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title mb-3">
                        Pendapatan Makanan & Minuman
                    </h5>

                    <h3 class="mb-0">
                        Rp {{ number_format($pendapatanTambahanMingguIni, 0, ',', '.') }}
                    </h3>

                    <small class="text-muted">
                        Minggu ini dari reservasi yang disetujui
                    </small>

                </div>

            </div>

        </div>


        <!-- Produk Terlaris -->
        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5 class="card-title mb-3">
                        Produk Terlaris Minggu Ini
                    </h5>

                    @forelse($produkTerlarisMingguIni as $item)

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span>
                                {{ $item->produk->nama ?? '-' }}
                            </span>

                            <span class="badge bg-primary">
                                {{ $item->total_terjual }} terjual
                            </span>

                        </div>

                    @empty

                        <p class="text-muted mb-0">
                            Belum ada penjualan makanan atau minuman.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- RESERVASI TERBARU --}}
    {{-- ========================= --}}

    <div class="card mt-4">

        <div class="card-header bg-transparent">

            <div class="d-flex align-items-center">

                <div>
                    <h6 class="mb-0 fw-bold">
                        Reservasi Terbaru
                    </h6>

                    <small class="text-muted">
                        Aktivitas reservasi terbaru SportSpace
                    </small>
                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Kode</th>

                            <th>Pelanggan</th>

                            <th>Lapangan</th>

                            <th>Tanggal</th>

                            <th>Jam</th>

                            <th>Total</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($reservasiTerbaru as $reservasi)

                            <tr>

                                <td>

                                    <strong>
                                        {{ $reservasi->kode_reservasi }}
                                    </strong>

                                </td>


                                <td>
                                    {{ $reservasi->nama ?: ($reservasi->user->name ?? '-') }}
                                </td>


                                <td>

                                    {{ $reservasi->lapangan->nama ?? '-' }}

                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y') }}

                                </td>


                                <td>

                                    @if ($reservasi->slotWaktu)

                                        {{ $reservasi->slotWaktu->jam_mulai }}
                                        -
                                        {{ $reservasi->slotWaktu->jam_selesai }}

                                    @else

                                        -

                                    @endif

                                </td>


                                <td>

                                    Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}

                                </td>


                                <td>

                                    @if ($reservasi->status === 'Disetujui')

                                        <span class="badge bg-success">
                                            Disetujui
                                        </span>

                                    @elseif ($reservasi->status === 'Menunggu')

                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4">

                                    Belum ada reservasi.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @push('scripts')

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const laporan = @json($laporanMingguan);

                const labels = laporan.map(item => item.tanggal);

                const menunggu = laporan.map(item => item.menunggu);
                const disetujui = laporan.map(item => item.disetujui);
                const ditolak = laporan.map(item => item.ditolak);

                const options = {
                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },

                    // WARNA MASING-MASING STATUS
                    colors: [
                        '#ffc107', // Menunggu - kuning
                        '#198754', // Disetujui - hijau
                        '#dc3545'  // Ditolak - merah
                    ],

                    series: [
                        {
                            name: 'Menunggu',
                            data: menunggu
                        },
                        {
                            name: 'Disetujui',
                            data: disetujui
                        },
                        {
                            name: 'Ditolak',
                            data: ditolak
                        }
                    ],

                    xaxis: {
                        categories: labels,
                        title: {
                            text: 'Hari',
                            style: {
                                color: '#6c757d'
                            }
                        },
                        labels: {
                            style: {
                                colors: '#6c757d'
                            }
                        }
                    },

                    yaxis: {
                        min: 0,
                        forceNiceScale: true,
                        title: {
                            text: 'Jumlah Reservasi',
                            style: {
                                color: '#6c757d'
                            }
                        },
                        labels: {
                            style: {
                                colors: '#6c757d'
                            }
                        }
                    },

                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },

                    markers: {
                        size: 4,
                        hover: {
                            size: 6
                        }
                    },

                    dataLabels: {
                        enabled: false
                    },

                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        labels: {
                            colors: ['#ffc107', '#198754', '#dc3545']
                        }
                    },

                    tooltip: {
                        shared: true,
                        intersect: false
                    },

                    grid: {
                        borderColor: '#e5e7eb'
                    }
                };

                const chart = new ApexCharts(
                    document.querySelector("#weeklyReservationChart"),
                    options
                );

                chart.render();
            });


        </script>

    @endpush
@endsection
