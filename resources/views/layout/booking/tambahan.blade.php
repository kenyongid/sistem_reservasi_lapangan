@extends('layout.landing')

@section('content')

    <div class="container py-5">

        <div class="text-center mb-5">

            <h2>
                Tambahkan Makanan & Minuman
            </h2>

            <p class="text-muted">
                Lengkapi reservasi Anda dengan makanan dan minuman.
                Pilihan ini bersifat opsional.
            </p>

        </div>


        {{-- INFORMASI RESERVASI --}}
        <div class="card mb-4">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">
                        <small class="text-muted">
                            Lapangan
                        </small>

                        <div class="fw-bold">
                            {{ $reservasi->lapangan->nama ?? '-' }}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <small class="text-muted">
                            Tanggal
                        </small>

                        <div class="fw-bold">
                            {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y') }}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <small class="text-muted">
                            Waktu
                        </small>

                        <div class="fw-bold">

                            @if($reservasi->slotWaktu)

                                {{ $reservasi->slotWaktu->jam_mulai }}
                                -
                                {{ $reservasi->slotWaktu->jam_selesai }}

                            @else

                                -

                            @endif

                        </div>
                    </div>

                </div>

            </div>

        </div>


        <form action="{{ route('booking.tambahan.simpan', $reservasi->id) }}" method="POST">

            @csrf


            {{-- MAKANAN --}}
            <div class="mb-4">

                <h4 class="mb-3">
                    Makanan
                </h4>

                <div class="row">

                    @forelse($produk->where('kategori', 'Makanan') as $item)

                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="card h-100">

                                @if($item->gambar)

                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                        style="height: 180px; object-fit: cover;" alt="{{ $item->nama }}">

                                @endif

                                <div class="card-body">

                                    <h5>
                                        {{ $item->nama }}
                                    </h5>

                                    @if($item->deskripsi)
                                        <p class="text-muted small">
                                            {{ $item->deskripsi }}
                                        </p>
                                    @endif

                                    <div class="fw-bold mb-3">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>


                                    <div class="form-check mb-2">

                                        <input class="form-check-input produk-check" type="checkbox"
                                            name="produk[{{ $item->id }}][id]" value="{{ $item->id }}"
                                            id="produk-{{ $item->id }}">

                                        <label class="form-check-label" for="produk-{{ $item->id }}">
                                            Tambahkan
                                        </label>

                                    </div>


                                    <input type="number" name="produk[{{ $item->id }}][jumlah]" class="form-control" value="1"
                                        min="1" disabled>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">
                            <p class="text-muted">
                                Belum tersedia makanan.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>


            {{-- MINUMAN --}}
            <div class="mb-4">

                <h4 class="mb-3">
                    Minuman
                </h4>

                <div class="row">

                    @forelse($produk->where('kategori', 'Minuman') as $item)

                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="card h-100">

                                @if($item->gambar)

                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                        style="height: 180px; object-fit: cover;" alt="{{ $item->nama }}">

                                @endif

                                <div class="card-body">

                                    <h5>
                                        {{ $item->nama }}
                                    </h5>

                                    @if($item->deskripsi)
                                        <p class="text-muted small">
                                            {{ $item->deskripsi }}
                                        </p>
                                    @endif

                                    <div class="fw-bold mb-3">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>


                                    <div class="form-check mb-2">

                                        <input class="form-check-input produk-check" type="checkbox"
                                            name="produk[{{ $item->id }}][id]" value="{{ $item->id }}"
                                            id="produk-{{ $item->id }}">

                                        <label class="form-check-label" for="produk-{{ $item->id }}">
                                            Tambahkan
                                        </label>

                                    </div>


                                    <input type="number" name="produk[{{ $item->id }}][jumlah]" class="form-control" value="1"
                                        min="1" disabled>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">
                            <p class="text-muted">
                                Belum tersedia minuman.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>


            {{-- TOMBOL --}}
            <div class="text-center mt-4">

                <p class="text-muted">
                    Tidak ingin menambahkan makanan atau minuman?
                    Langsung selesaikan pemesanan.
                </p>

                <button type="submit" class="btn btn-primary px-4">
                    Selesai Pemesanan
                </button>

            </div>

        </form>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const checkboxes = document.querySelectorAll('.produk-check');

            checkboxes.forEach(function (checkbox) {

                checkbox.addEventListener('change', function () {

                    const quantity = this
                        .closest('.card-body')
                        .querySelector('input[type="number"]');

                    quantity.disabled = !this.checked;

                });

            });

        });
    </script>

@endsection