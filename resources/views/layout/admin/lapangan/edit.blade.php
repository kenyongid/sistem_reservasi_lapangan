@extends('layout.admin')

@section('title', 'Edit Lapangan - SportSpace')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="mb-1">
                Edit Lapangan
            </h4>

            <p class="text-muted mb-0">
                Perbarui informasi lapangan.
            </p>

        </div>


        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card radius-10">

            <div class="card-body">

                <form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">

    <label class="form-label">
        Foto Lapangan
    </label>

    @if($lapangan->gambar)

        <div class="mb-2">
            <img
                src="{{ asset('storage/' . $lapangan->gambar) }}"
                alt="{{ $lapangan->nama }}"
                style="width: 180px; height: 100px; object-fit: cover; border-radius: 8px;"
            >
        </div>

    @endif

    <input
        type="file"
        name="gambar"
        class="form-control"
        accept="image/*"
    >

    <small class="text-muted">
        Kosongkan jika tidak ingin mengganti foto.
    </small>

</div>
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lapangan
                        </label>

                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $lapangan->nama) }}" required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Olahraga
                        </label>

                        <select name="jenis_olahraga_id" class="form-select" required>

                            @foreach($jenisOlahraga as $jenis)

                                <option value="{{ $jenis->id }}" {{ $lapangan->jenis_olahraga_id == $jenis->id ? 'selected' : '' }}>

                                    {{ $jenis->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Harga Per Jam
                        </label>

                        <input type="number" name="harga_per_jam" class="form-control" value="{{ old(
        'harga_per_jam',
        $lapangan->harga_per_jam
    ) }}" min="0" required>

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select" required>

                            <option value="aktif" {{ $lapangan->status === 'aktif'
        ? 'selected'
        : '' }}>
                                Aktif
                            </option>

                            <option value="nonaktif" {{ $lapangan->status === 'nonaktif'
        ? 'selected'
        : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <a href="{{ route('admin.lapangan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection