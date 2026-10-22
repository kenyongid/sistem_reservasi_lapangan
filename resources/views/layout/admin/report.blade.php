@extends('layout.admin')

@section('title', 'Laporan Reservasi - SportSpace')

@section('content')

    <div class="container-fluid">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="mb-4">

            <h4 class="mb-1">
                Laporan Reservasi
            </h4>

            <p class="text-muted mb-0">
                Lihat dan rekap data reservasi berdasarkan periode yang dipilih.
            </p>

        </div>


        {{-- ===================================================== --}}
        {{-- FILTER PERIODE --}}
        {{-- ===================================================== --}}

        <div class="card mb-4">

            <div class="card-body">

                <h5 class="card-title mb-3">
                    Filter Laporan
                </h5>


                <form action="{{ route('admin.report') }}" method="GET">

                    <div class="row g-3">

                        {{-- JENIS PERIODE --}}
                        <div class="col-md-3">

                            <label for="period" class="form-label">
                                Jenis Periode
                            </label>

                            <select name="period" id="period" class="form-select">

                                <option value="range" {{ request('period', 'range') === 'range' ? 'selected' : '' }}>

                                    Rentang Tanggal

                                </option>

                                <option value="month" {{ request('period') === 'month' ? 'selected' : '' }}>

                                    Bulan

                                </option>

                            </select>

                        </div>


                        {{-- TANGGAL MULAI --}}
                        <div class="col-md-3" id="startDateWrapper">

                            <label for="start_date" class="form-label">

                                Tanggal Mulai

                            </label>

                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ request('start_date') }}">

                        </div>


                        {{-- TANGGAL AKHIR --}}
                        <div class="col-md-3" id="endDateWrapper">

                            <label for="end_date" class="form-label">

                                Tanggal Akhir

                            </label>

                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ request('end_date') }}">

                        </div>


                        {{-- BULAN --}}
                        <div class="col-md-3" id="monthWrapper">

                            <label for="month" class="form-label">

                                Bulan

                            </label>

                            <input type="month" name="month" id="month" class="form-control" value="{{ request('month') }}">

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-search"></i>
                                Tampilkan Laporan

                            </button>


                            <a href="{{ route('admin.report') }}" class="btn btn-secondary">

                                <i class="bi bi-arrow-counterclockwise"></i>
                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PERIODE AKTIF --}}
        {{-- ===================================================== --}}

        <div class="card mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="mb-1">
                            Periode Laporan
                        </h5>

                        <h4 class="mb-0">

                            {{ $awalPeriode->translatedFormat('d F Y') }}

                            -

                            {{ $akhirPeriode->translatedFormat('d F Y') }}

                        </h4>

                    </div>


                    {{-- TOMBOL EXPORT --}}
                    <div class="d-flex gap-2 flex-wrap">

                        {{-- PDF --}}
                        <a href="{{ route('admin.report.pdf', request()->query()) }}" class="btn btn-danger">

                            <i class="bi bi-file-earmark-pdf"></i>
                            PDF

                        </a>


                        {{-- EXCEL --}}
                        <a href="{{ route('admin.report.excel', request()->query()) }}" class="btn btn-success">

                            <i class="bi bi-file-earmark-excel"></i>
                            Excel

                        </a>


                        {{-- CSV --}}
                        <a href="{{ route('admin.report.csv', request()->query()) }}" class="btn btn-primary">

                            <i class="bi bi-filetype-csv"></i>
                            CSV

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- RINGKASAN --}}
        {{-- ===================================================== --}}

        <div class="row mb-4">

            {{-- TOTAL RESERVASI --}}
            <div class="col-md-3 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Total Reservasi
                        </h6>

                        <h3 class="mb-0">
                            {{ $totalReservasi }}
                        </h3>

                    </div>

                </div>

            </div>


            {{-- DISETUJUI --}}
            <div class="col-md-3 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Disetujui
                        </h6>

                        <h3 class="text-success mb-0">
                            {{ $totalDisetujui }}
                        </h3>

                    </div>

                </div>

            </div>


            {{-- MENUNGGU --}}
            <div class="col-md-3 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Menunggu
                        </h6>

                        <h3 class="text-warning mb-0">
                            {{ $totalMenunggu }}
                        </h3>

                    </div>

                </div>

            </div>


            {{-- DITOLAK --}}
            <div class="col-md-3 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Ditolak
                        </h6>

                        <h3 class="text-danger mb-0">
                            {{ $totalDitolak }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PENDAPATAN --}}
        {{-- ===================================================== --}}

        <div class="row mb-4">

            <div class="col-md-6 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Total Pendapatan
                        </h6>

                        <h3 class="text-success mb-0">

                            Rp{{ number_format($totalPendapatan, 0, ',', '.') }}

                        </h3>

                        <small class="text-muted">
                            Hanya reservasi yang disetujui
                        </small>

                    </div>

                </div>

            </div>


            <div class="col-md-6 mb-3">

                <div class="card h-100">

                    <div class="card-body">

                        <h6 class="text-muted mb-2">
                            Pendapatan Makanan & Minuman
                        </h6>

                        <h3 class="mb-0">

                            Rp{{ number_format($totalPendapatanTambahan, 0, ',', '.') }}

                        </h3>

                        <small class="text-muted">
                            Dari reservasi yang disetujui
                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PRODUK TERLARIS --}}
        {{-- ===================================================== --}}

        @if($produkTerlaris->count() > 0)

            <div class="card mb-4">

                <div class="card-body">

                    <h5 class="mb-3">
                        Produk Terlaris
                    </h5>


                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Pendapatan</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($produkTerlaris as $produk)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            {{ $produk->produk->nama ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $produk->total_terjual }}
                                        </td>

                                        <td>

                                            Rp{{ number_format($produk->total_pendapatan, 0, ',', '.') }}

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- TABEL RESERVASI --}}
        {{-- ===================================================== --}}

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="mb-1">
                            Rekap Reservasi
                        </h5>

                        <small class="text-muted">

                            {{ $totalReservasi }}
                            data ditemukan

                        </small>

                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Lapangan</th>
                                <th>Olahraga</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Total</th>
                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($reservasi as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- KODE --}}
                                    <td>

                                        <strong>
                                            {{ $item->kode_reservasi }}
                                        </strong>

                                    </td>


                                    {{-- PELANGGAN --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $item->nama ?: ($item->user->name ?? '-') }}

                                        </div>

                                        @if($item->email)

                                            <small class="text-muted">

                                                {{ $item->email }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- LAPANGAN --}}
                                    <td>

                                        <strong>

                                            {{ $item->lapangan->nama ?? '-' }}

                                        </strong>

                                    </td>


                                    {{-- OLAHRAGA --}}
                                    <td>

                                        {{ $item->lapangan->jenisOlahraga->nama ?? '-' }}

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        @if($item->tanggal)
                                                                    {{ \Carbon\Carbon::parse(
                                                $item->tanggal
                                            )->format('d-m-Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- JAM --}}
                                    <td>

                                        @if($item->slotWaktu)
                                            {{ substr($item->slotWaktu->jam_mulai, 0, 5) }}

                                            -
                                            {{ substr($item->slotWaktu->jam_selesai, 0, 5) }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                        Rp{{ number_format($item->total_harga, 0, ',', '.') }}

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($item->status === 'Disetujui')

                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>

                                        @elseif($item->status === 'Menunggu')

                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>

                                        @elseif($item->status === 'Ditolak')

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ $item->status }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center py-4">

                                        Tidak ada reservasi pada periode ini.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT FILTER --}}
    {{-- ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const period = document.getElementById('period');

            const startDateWrapper =
                document.getElementById('startDateWrapper');

            const endDateWrapper =
                document.getElementById('endDateWrapper');

            const monthWrapper =
                document.getElementById('monthWrapper');


            function updateFilter() {

                if (period.value === 'month') {

                    startDateWrapper.style.display = 'none';
                    endDateWrapper.style.display = 'none';

                    monthWrapper.style.display = 'block';

                } else {

                    startDateWrapper.style.display = 'block';
                    endDateWrapper.style.display = 'block';

                    monthWrapper.style.display = 'none';

                }

            }


            period.addEventListener(
                'change',
                updateFilter
            );


            updateFilter();

        });

    </script>

@endsection