<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman manajemen kategori (daftar, form tambah, dan form edit).
     * Menerima model Kategori opsional untuk mode edit.
     */
    public function index(Kategori $kategori = null)
    {
        $kategoris = Kategori::latest()->get();

        return view('admin.kategori.index', [
            'kategoris' => $kategoris,
            'kategori_edit' => $kategori // Kirim data kategori yang akan diedit ke view
        ]);
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Tambahkan validasi 'unique' untuk mencegah nama kategori yang sama
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Mengupdate data kategori yang ada.
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi 'unique' harus mengabaikan data yang sedang diedit saat ini
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus data kategori.
     */
    public function destroy(Kategori $kategori)
    {
        // Tambahkan pengecekan relasi sebelum menghapus
        if ($kategori->produks()->count() > 0) {
            return redirect()->route('admin.kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // Method create() dan edit() sudah tidak diperlukan lagi, jadi bisa dihapus.
}