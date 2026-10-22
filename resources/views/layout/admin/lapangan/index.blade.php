@extends('layout.admin')

@section('title', 'Lapangan - SportSpace')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">

            <div>
                <h4 class="mb-1">Daftar Lapangan</h4>
                <p class="text-muted mb-0">
                    Kelola data lapangan olahraga SportSpace.
                </p>
            </div>

            <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-circle me-1"></i>
                Tambah Lapangan

            </a>

        </div>


        {{-- Pesan sukses --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- Tabel --}}
        <div class="card radius-10">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Foto</th>

                                <th>Nama Lapangan</th>

                                <th>Jenis Olahraga</th>

                                <th>Harga / Jam</th>

                                <th>Status</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($lapangan as $item)

                                                    <tr>

                                                        {{-- Nomor --}}
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>


                                                        {{-- Foto --}}
                                                        <td>

                                                            @if($item->gambar)

                                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" style="
                                                                                width: 70px;
                                                                                height: 50px;
                                                                                object-fit: cover;
                                                                                border-radius: 6px;
                                                                            ">

                                                            @else

                                                                <div class="bg-light d-flex align-items-center justify-content-center" style="
                                                                                width: 70px;
                                                                                height: 50px;
                                                                                border-radius: 6px;
                                                                            ">

                                                                    <i class="bi bi-image text-muted"></i>

                                                                </div>

                                                            @endif

                                                        </td>


                                                        {{-- Nama --}}
                                                        <td>

                                                            <strong>
                                                                {{ $item->nama }}
                                                            </strong>

                                                        </td>


                                                        {{-- Jenis olahraga --}}
                                                        <td>

                                                            {{ $item->jenisOlahraga->nama ?? '-' }}

                                                        </td>


                                                        {{-- Harga --}}
                                                        <td>

                                                            Rp
                                                            {{ number_format(
                                    $item->harga_per_jam,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                                        </td>


                                                        {{-- Status --}}
                                                        <td>

                                                            @if($item->status === 'aktif')

                                                                <span class="badge bg-success">
                                                                    Aktif
                                                                </span>

                                                            @else

                                                                <span class="badge bg-secondary">
                                                                    Nonaktif
                                                                </span>

                                                            @endif

                                                        </td>


                                                        {{-- Aksi --}}
                                                        <td>

                                                            {{-- Detail --}}
                                                            <a href="{{ route(
                                    'admin.lapangan.show',
                                    $item->id
                                ) }}" class="btn btn-sm btn-info" title="Lihat">

                                                                <i class="bi bi-eye"></i>

                                                            </a>


                                                            {{-- Edit --}}
                                                            <a href="{{ route(
                                    'admin.lapangan.edit',
                                    $item->id
                                ) }}" class="btn btn-sm btn-warning" title="Edit">

                                                                <i class="bi bi-pencil"></i>

                                                            </a>


                                                            {{-- Hapus --}}
                                                            <form action="{{ route(
                                    'admin.lapangan.destroy',
                                    $item->id
                                ) }}" method="POST" class="d-inline" onsubmit="return confirm(
                                                                        'Yakin ingin menghapus lapangan ini?'
                                                                    );">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">

                                                                    <i class="bi bi-trash"></i>

                                                                </button>

                                                            </form>

                                                        </td>

                                                    </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-4">

                                        <i class="bi bi-inbox fs-3 text-muted"></i>

                                        <p class="mb-0 mt-2">
                                            Belum ada data lapangan.
                                        </p>

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