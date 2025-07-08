<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    $data = $request->validate([
        'nama' => 'required|string|max:255',
        'aktor' => 'nullable|string|max:255', // Validasi untuk aktor
        'nomor_hp' => 'nullable|string|max:255',
        'isi' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'foto' => 'nullable|image|max:1024', // Validasi untuk foto (max 1MB)
    ]);

    $data['tampilkan'] = $request->has('tampilkan');

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('testimoni', 'public');
    }

    Testimoni::create($data);

    if ($request->is('admin/*')) {
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    } else {
        return redirect()->route('testimoni-form')->with('sent', 'Pesan kamu telah dikirim. Terima kasih!');
    }


}

    /**
     * Mengupdate testimoni yang ada.
     */
    public function update(Request $request, Testimoni $testimoni)
{
    $data = $request->validate([
        'nama' => 'required|string|max:255',
        'aktor' => 'nullable|string|max:255',
        'nomor_hp' => 'nullable|string|max:255',
        'isi' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'foto' => 'nullable|image|max:1024',
    ]);

    $data['tampilkan'] = $request->has('tampilkan');

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($testimoni->foto) {
            Storage::disk('public')->delete($testimoni->foto);
        }
        $data['foto'] = $request->file('foto')->store('testimoni', 'public');
    }

    $testimoni->update($data);

    return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
}

    /**
     * Menghapus testimoni.
     */
    public function destroy(Testimoni $testimoni)
{

    if ($testimoni->foto) {
        Storage::disk('public')->delete($testimoni->foto);
    }

    $testimoni->delete();

    return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
}

public function toggleTampilkan(Request $request, $id)
{
    $testimoni = Testimoni::findOrFail($id);
    $testimoni->tampilkan = $request->input('tampilkan') ? 1 : 0;
    $testimoni->save();

    return response()->json(['success' => true]);
}

}