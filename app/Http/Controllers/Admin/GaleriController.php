<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $galeri_edit = null;
        if ($request->filled('edit')) {
            $galeri_edit = Galeri::find($request->edit);
        }

        $galeris = $query->latest()->paginate(9);

        return view('admin.galeri.index', compact('galeris', 'galeri_edit'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:foto,video',
            'file_upload' => 'required_if:tipe,foto|image|max:5120',
            'video_link' => 'nullable|url',
        ]);

        if ($request->tipe === 'video' && !$request->video_link) {
            return back()->withErrors(['video_link' => 'Link video wajib diisi.'])->withInput();
        }

        $data['status'] = $request->status;

        if ($request->tipe === 'foto' && $request->hasFile('file_upload')) {
            $data['file'] = $request->file('file_upload')->store('galeri', 'public');
        } elseif ($request->tipe === 'video') {
            $data['file'] = $request->video_link;
        }

        unset($data['file_upload'], $data['video_link']);

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:foto,video',
            'file_upload' => 'nullable|image|max:5120',
            'video_link' => 'nullable|required_if:tipe,video|url',
        ]);

        $data['status'] = $request->status;
        $tipeLama = $galeri->tipe;

        if ($request->hasFile('file_upload')) {
            if ($tipeLama === 'foto' && $galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $data['file'] = $request->file('file_upload')->store('galeri', 'public');
        } elseif ($request->tipe === 'video') {
            if ($tipeLama === 'foto' && $galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $data['file'] = $request->video_link;
        }

        unset($data['file_upload'], $data['video_link']);

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->tipe === 'foto' && $galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil dihapus.');
    }
}
