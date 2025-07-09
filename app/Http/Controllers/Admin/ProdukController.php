<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
            'pesan_wa' => 'nullable|string',
        ]);

        // [BARIS BARU] Tangani input checkbox 'is_unggulan'
        $data['is_unggulan'] = $request->has('is_unggulan');

        // [LOGIKA LAMA ANDA] Handle file upload
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // [LOGIKA BARU] Tambahkan slug secara otomatis
        $data['slug'] = Str::slug($request->nama);

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
            'pesan_wa' => 'nullable|string',
        ]);

        // [BARIS BARU] Tangani input checkbox 'is_unggulan'
        $data['is_unggulan'] = $request->has('is_unggulan');
        
        // [LOGIKA BARU] Tambahkan slug secara otomatis saat update
        $data['slug'] = Str::slug($request->nama);

        // [LOGIKA LAMA ANDA] Handle file upload jika ada file baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Gunakan ->update() agar lebih rapi dan konsisten
        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}