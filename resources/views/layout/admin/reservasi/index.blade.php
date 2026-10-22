@extends('layout.admin')

@section('title', 'Reservasi - SportSpace')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">
            <h4 class="mb-1">
                Data Reservasi
            </h4>

            <p class="text-muted mb-0">
                Kelola reservasi lapangan SportSpace.
            </p>
        </div>


        {{-- PESAN SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- TABEL RESERVASI --}}
        <div class="card radius-10">

            <div class="card-body">

                {{-- URUTKAN RESERVASI --}}
                <form action="{{ route('admin.reservasi.index') }}" method="GET" class="row g-2 align-items-center mb-3">

                    <div class="col-auto">

                        <label for="sort" class="form-label mb-0">
                            Urutkan:
                        </label>

                    </div>

                    <div class="col-md-3 col-sm-6">

                        <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">

                            <option value="created_at" {{ request('sort', 'created_at') === 'created_at' ? 'selected' : '' }}>
                                Terbaru
                            </option>

                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                                Terlama
                            </option>

                            <option value="tanggal_asc" {{ request('sort') === 'tanggal_asc' ? 'selected' : '' }}>
                                Tanggal terdekat
                            </option>

                            <option value="tanggal_desc" {{ request('sort') === 'tanggal_desc' ? 'selected' : '' }}>
                                Tanggal terjauh
                            </option>

                            <option value="status" {{ request('sort') === 'status' ? 'selected' : '' }}>
                                Status
                            </option>

                            <option value="total_harga" {{ request('sort') === 'total_harga' ? 'selected' : '' }}>
                                Total Harga Terbesar
                            </option>

                        </select>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table align-middle">


                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Lapangan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Sisa Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($reservasi as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- KODE RESERVASI --}}
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

                                        <br>

                                        <small class="text-muted">
                                            {{ $item->lapangan->jenisOlahraga->nama ?? '-' }}
                                        </small>

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        @if($item->tanggal)

                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- JAM --}}
                                    <td>

                                        @if($item->slotWaktu)

                                            {{ $item->slotWaktu->jam_mulai }}
                                            -
                                            {{ $item->slotWaktu->jam_selesai }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- TOTAL HARGA --}}
                                    <td>

                                        Rp
                                        {{ number_format($item->total_harga, 0, ',', '.') }}

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($item->status === 'Menunggu')

                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>

                                        @elseif($item->status === 'Disetujui')

                                            <span class="badge bg-success">
                                                Disetujui
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


                                    {{-- SISA WAKTU --}}
                                    <td>

                                        @if($item->status === 'Ditolak')

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @elseif(isset($item->sisa_waktu))

                                            @if($item->sisa_waktu === 'Sudah dimulai')

                                                <span class="badge bg-secondary">
                                                    Sudah dimulai
                                                </span>

                                            @else

                                                <span class="text-primary">
                                                    {{ $item->sisa_waktu }}
                                                </span>

                                            @endif

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.reservasi.show', $item->id) }}" class="btn btn-sm btn-info"
                                            title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- APPROVAL --}}
                                        @if($item->status === 'Menunggu')

                                            {{-- SETUJUI --}}
                                            <form action="{{ route('admin.reservasi.setujui', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Setujui reservasi ini?');">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>

                                            </form>


                                            {{-- TOLAK --}}
                                            <form action="{{ route('admin.reservasi.tolak', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menolak reservasi ini?');">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit" class="btn btn-sm btn-danger" title="Tolak">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>

                                            </form>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        Belum ada reservasi.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection