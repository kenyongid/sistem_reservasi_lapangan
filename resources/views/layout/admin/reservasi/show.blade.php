@extends('layout.admin')

@section('title', 'Detail Reservasi - SportSpace')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="mb-1">
                Detail Reservasi
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap reservasi pelanggan.
            </p>

        </div>


        {{-- CARD DETAIL --}}
        <div class="card radius-10">

            <div class="card-body">

                <div class="row">

                    {{-- INFORMASI RESERVASI --}}
                    <div class="col-md-6">

                        <h6 class="fw-bold mb-3">
                            Informasi Reservasi
                        </h6>

                        <table class="table">

                            <tr>
                                <th width="40%">
                                    Kode Reservasi
                                </th>

                                <td>
                                    {{ $reservasi->kode_reservasi }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Pelanggan
                                </th>

                                <td>
                                    {{ $reservasi->nama ?: ($reservasi->user->name ?? '-') }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Email
                                </th>

                                <td>
                                    {{ $reservasi->email ?: ($reservasi->user->email ?? '-') }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Telepon
                                </th>

                                <td>
                                    {{ $reservasi->telepon ?: '-' }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Lapangan
                                </th>

                                <td>
                                    {{ $reservasi->lapangan->nama ?? '-' }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Jenis Olahraga
                                </th>

                                <td>
                                    {{ $reservasi->lapangan->jenisOlahraga->nama ?? '-' }}
                                </td>
                            </tr>

                        </table>

                    </div>


                    {{-- JADWAL --}}
                    <div class="col-md-6">

                        <h6 class="fw-bold mb-3">
                            Jadwal
                        </h6>

                        <table class="table">

                            <tr>
                                <th width="40%">
                                    Tanggal
                                </th>

                                <td>
                                    @if($reservasi->tanggal)

                                        {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y') }}

                                    @else

                                        -

                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Waktu
                                </th>

                                <td>

                                    @if($reservasi->slotWaktu)

                                        {{ $reservasi->slotWaktu->jam_mulai }}
                                        -
                                        {{ $reservasi->slotWaktu->jam_selesai }}

                                    @else

                                        -

                                    @endif

                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Total Harga
                                </th>

                                <td>
                                    Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Status
                                </th>

                                <td>

                                    @if($reservasi->status === 'Menunggu')

                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>

                                    @elseif($reservasi->status === 'Disetujui')

                                        <span class="badge bg-success">
                                            Disetujui
                                        </span>

                                    @elseif($reservasi->status === 'Ditolak')

                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $reservasi->status ?? '-' }}
                                        </span>

                                    @endif

                                </td>
                            </tr>


                            <tr>
                                <th>
                                    Catatan
                                </th>

                                <td>
                                    {{ $reservasi->catatan ?: '-' }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>


                {{-- TOMBOL AKSI --}}
                <div class="mt-4">

                    <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <a href="{{ route('admin.reservasi.destroy', $reservasi->id) }}" class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus reservasi ini?');">
                        Hapus
                    </a>


                    @if($reservasi->status === 'Menunggu')

                        {{-- SETUJUI --}}
                        <form action="{{ route('admin.reservasi.setujui', $reservasi->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Setujui reservasi ini?');">

                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-lg me-1"></i>
                                Setujui
                            </button>

                        </form>


                        {{-- TOLAK --}}
                        <form action="{{ route('admin.reservasi.tolak', $reservasi->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menolak reservasi ini?');">

                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-lg me-1"></i>
                                Tolak
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection