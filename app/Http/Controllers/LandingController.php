<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\JenisOlahraga;
use App\Models\Reservasi;

class LandingController extends Controller
{
    public function index()
    {
        $jenisOlahraga = JenisOlahraga::count();

        $jumlahLapangan = Lapangan::where('status', 'aktif')->count();

        $jumlahReservasi = Reservasi::count();

        $lapangan = Lapangan::with('jenisOlahraga')
            ->where('status', 'aktif')
            ->get();

        return view('layout.landing.index', compact(
            'jenisOlahraga',
            'jumlahLapangan',
            'jumlahReservasi',
            'lapangan'
        ));
    }
}