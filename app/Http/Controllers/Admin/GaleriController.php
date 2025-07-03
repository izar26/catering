<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan halaman manajemen galeri (daftar dan form).
     */
    public function index(Galeri $galeri = null)
    {
        return view('admin.galeri.index', [
            'galeris' => Galeri::latest()->paginate(9), // Paginate 9 agar pas di grid 3 kolom
            'galeri_edit' => $galeri // Kirim data galeri yang akan diedit ke view
        ]);
    }

    /**
     * Menyimpan item galeri baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:foto,video',
            'file_upload' => 'required_if:tipe,foto|image|max:5120',
            'video_link' => 'required_if:tipe,video|url',
        ]);

        // Siapkan data untuk disimpan
        $dataToStore = [
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'tipe' => $data['tipe'],
        ];

        if ($data['tipe'] === 'foto' && $request->hasFile('file_upload')) {
            $dataToStore['file'] = $request->file('file_upload')->store('galeri', 'public');
        } elseif ($data['tipe'] === 'video') {
            $dataToStore['file'] = $data['video_link'];
        }

        Galeri::create($dataToStore);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    /**
     * Mengupdate item galeri yang ada.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:foto,video',
            'file_upload' => 'nullable|image|max:5120', // Dibuat nullable karena mungkin tidak ganti gambar
            'video_link' => 'nullable|url',
        ]);

        $dataToUpdate = [
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'tipe' => $data['tipe'],
        ];

        if ($data['tipe'] === 'foto') {
            if ($request->hasFile('file_upload')) {
                // Hapus file lama jika ada & tipenya memang foto
                if ($galeri->tipe === 'foto' && $galeri->file) {
                    Storage::disk('public')->delete($galeri->file);
                }
                $dataToUpdate['file'] = $request->file('file_upload')->store('galeri', 'public');
            }
        } else { // Jika tipe baru adalah 'video'
            // Hapus file foto lama jika tipe sebelumnya adalah 'foto'
            if ($galeri->tipe === 'foto' && $galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $dataToUpdate['file'] = $data['video_link'];
        }

        $galeri->update($dataToUpdate);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    /**
     * Menghapus item galeri.
     */
    public function destroy(Galeri $galeri)
    {
        // Hapus file foto dari storage jika ada
        if ($galeri->tipe === 'foto' && $galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil dihapus.');
    }
}