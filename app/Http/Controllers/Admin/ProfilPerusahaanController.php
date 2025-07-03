<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPerusahaanController extends Controller
{
    public function edit()
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan;
        return view('admin.profil.edit', compact('profil'));
    }

     public function update(Request $request)
    {
        // 1. Validasi yang lebih lengkap
        $validatedData = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_wa' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'youtube' => 'nullable|url|max:255',
            'service_hours' => 'nullable|string|max:255',
            'fast_response' => 'nullable|string|max:255',
            'tentang_kami' => 'nullable|string|max:255',
        ]);

        // Mengambil data profil atau membuat baru jika belum ada
        $profil = ProfilPerusahaan::firstOrNew();

        // 2. Logika upload logo (tetap sama, sudah bagus)
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            // Simpan logo baru dan tambahkan path-nya ke data yang divalidasi
            $validatedData['logo'] = $request->file('logo')->store('logo', 'public');
        }

        // 3. Menggunakan Mass Assignment (lebih bersih dan efisien)
        // Cukup isi model dengan semua data yang sudah tervalidasi
        $profil->fill($validatedData);
        
        // 4. Simpan ke database
        $profil->save();

        return redirect()->back()->with('success', 'Profil usaha berhasil diperbarui.');
    }
    public function editInfoPemesanan()
{
    $profil = ProfilPerusahaan::firstOrFail();
    return view('admin.info_pemesanan.edit', compact('profil'));
}
}

