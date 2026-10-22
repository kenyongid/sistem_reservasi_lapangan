<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\JenisOlahraga;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Menampilkan daftar lapangan.
     */
    public function index()
    {
        $lapangan = Lapangan::with('jenisOlahraga')
            ->orderBy('id', 'desc')
            ->get();

        return view('layout.admin.lapangan.index', compact('lapangan'));
    }


    /**
     * Form tambah lapangan.
     */
    public function create()
    {
        $jenisOlahraga = JenisOlahraga::orderBy('nama')->get();

        return view(
            'layout.admin.lapangan.create',
            compact('jenisOlahraga')
        );
    }


    /**
     * Menyimpan lapangan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('lapangan', 'public');
        }
        Lapangan::create($validated);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail lapangan.
     */
    public function show(Lapangan $lapangan)
    {
        $lapangan->load('jenisOlahraga');

        return view(
            'layout.admin.lapangan.detail',
            compact('lapangan')
        );
    }


    /**
     * Form edit lapangan.
     */
    public function edit(Lapangan $lapangan)
    {
        $jenisOlahraga = JenisOlahraga::orderBy('nama')->get();

        return view(
            'layout.admin.lapangan.edit',
            compact('lapangan', 'jenisOlahraga')
        );
    }


    /**
     * Memperbarui lapangan.
     */
    public function update(Request $request, Lapangan $lapangan)
    {
    
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('lapangan', 'public');
        }

        $lapangan->update($validated);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }


    /**
     * Menghapus lapangan.
     */
    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}