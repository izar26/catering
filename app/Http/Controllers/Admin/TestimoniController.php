<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman manajemen testimoni (daftar & form).
     */
    public function index(Testimoni $testimoni = null)
    {
        $testimonis = Testimoni::latest()->paginate(10);

        // Kirim data testimoni yang akan diedit ($testimoni) ke view sebagai $testimoni_edit
        return view('admin.testimoni.index', [
            'testimonis' => $testimonis,
            'testimoni_edit' => $testimoni
        ]);
    }

    /**
     * Menyimpan testimoni baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Menangani input checkbox secara eksplisit
        $validatedData['tampilkan'] = $request->has('tampilkan');

        Testimoni::create($validatedData);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Mengupdate testimoni yang ada.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Menangani input checkbox secara eksplisit
        $validatedData['tampilkan'] = $request->has('tampilkan');

        $testimoni->update($validatedData);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Menghapus testimoni.
     */
    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    // Method create() dan edit() tidak diperlukan lagi dan bisa dihapus.
}