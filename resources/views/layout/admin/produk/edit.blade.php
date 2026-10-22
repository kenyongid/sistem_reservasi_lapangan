@extends('layout.admin')

@section('title', 'Edit produk - SportSpace')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="mb-1">
                Edit produk
            </h4>

            <p class="text-muted mb-0">
                Perbarui informasi produk.
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

                <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">
                            Foto produk
                        </label>

                        @if($produk->gambar)

                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                                    style="width: 180px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </div>

                        @endif

                        <input type="file" name="gambar" class="form-control" accept="image/*">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>
                    <div class="mb-3">

                        <label class="form-label">
                            Nama produk
                        </label>

                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Jenis makanan
                        </label>

                        <select name="kategori" class="form-select" required>
                            <option value="Makanan" {{ $produk->kategori === 'Makanan' ? 'selected' : '' }}>
                                Makanan
                            </option>

                            <option value="Minuman" {{ $produk->kategori === 'Minuman' ? 'selected' : '' }}>
                                Minuman
                            </option>
                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}"
                            min="0" required>

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select" required>

                            <option value="aktif" {{ $produk->status === 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="nonaktif" {{ $produk->status === 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">
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