<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('kategori')
            ->orderBy('nama')
            ->get();

        return view('layout.admin.produk.index', compact('produk'));
    }


    public function create()
    {
        return view('layout.admin.produk.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->only([
            'nama',
            'kategori',
            'deskripsi',
            'harga',
            'status',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show(Produk $produk)
    {
        return view('layout.admin.produk.show', compact('produk'));
    }


    public function edit(Produk $produk)
    {
        return view('layout.admin.produk.edit', compact('produk'));
    }


    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->only([
            'nama',
            'kategori',
            'deskripsi',
            'harga',
            'status',
        ]);

        if ($request->hasFile('gambar')) {

            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}