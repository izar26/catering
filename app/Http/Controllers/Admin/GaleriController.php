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
            'galeris' => Galeri::latest()->paginate(9),
            'galeri_edit' => $galeri
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
            'file_upload' => 'required_if:tipe,foto|image|max:5120', // Maks 5MB
            'video_link' => 'nullable|required_if:tipe,video|url',
        ]);

        // Jika tipenya foto, proses upload dan simpan path-nya di kolom 'file'
        if ($request->tipe === 'foto' && $request->hasFile('file_upload')) {
            $data['file'] = $request->file('file_upload')->store('galeri', 'public');
        } 
        // Jika tipenya video, simpan link-nya di kolom 'file'
        elseif ($request->tipe === 'video') {
            $data['file'] = $request->video_link;
        }

        // Hapus field sementara yang tidak ada di database
        unset($data['file_upload']);
        unset($data['video_link']);

        Galeri::create($data);

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
            'file_upload' => 'nullable|image|max:5120',
            'video_link' => 'nullable|required_if:tipe,video|url',
        ]);
        
        $tipeLama = $galeri->tipe;

        // Jika ada file foto baru yang di-upload
        if ($request->hasFile('file_upload')) {
            // Hapus file foto lama jika ada
            if ($tipeLama === 'foto' && $galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $data['file'] = $request->file('file_upload')->store('galeri', 'public');
        } 
        // Jika tipe baru adalah 'video'
        elseif ($request->tipe === 'video') {
            // Hapus file foto lama jika tipe sebelumnya adalah 'foto'
            if ($tipeLama === 'foto' && $galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $data['file'] = $request->video_link;
        }

        unset($data['file_upload']);
        unset($data['video_link']);

        $galeri->update($data);

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