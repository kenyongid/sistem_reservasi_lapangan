@extends('layout.admin')

@section('title', 'Tambah Lapangan - SportSpace')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="mb-1">
                Tambah Lapangan
            </h4>

            <p class="text-muted mb-0">
                Tambahkan lapangan baru ke SportSpace.
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

                <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">

                        <label class="form-label">
                            Foto Lapangan
                        </label>

                        <input type="file" name="gambar" class="form-control" accept="image/*">

                        <small class="text-muted">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lapangan
                        </label>

                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}"
                            placeholder="Contoh: Padel Court 1" required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Olahraga
                        </label>

                        <select name="jenis_olahraga_id" class="form-select" required>

                            <option value="">
                                -- Pilih Jenis Olahraga --
                            </option>

                            @foreach($jenisOlahraga as $jenis)

                                                <option value="{{ $jenis->id }}" {{ old('jenis_olahraga_id') == $jenis->id
                                ? 'selected'
                                : '' }}>

                                                    {{ $jenis->nama }}

                                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Harga Per Jam
                        </label>

                        <input type="number" name="harga_per_jam" class="form-control" value="{{ old('harga_per_jam') }}"
                            min="0" placeholder="150000" required>

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select" required>

                            <option value="aktif">
                                Aktif
                            </option>

                            <option value="nonaktif">
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <a href="{{ route('admin.lapangan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection