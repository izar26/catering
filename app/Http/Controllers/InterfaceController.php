<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Galeri;
use App\Models\ProfilPerusahaan;
use App\Models\Testimoni;

class InterfaceController extends Controller
{
    public function beranda()
    {
        // Ambil data pertama dari tabel profil_perusahaans
        $profil = ProfilPerusahaan::find(1); 

        // Kirim ke view
        return view('interface.beranda', compact('profil'));
    }

    public function menu()
    {
        $menus = Produk::with('kategori')->get(); // eager load biar hemat query
        $kategoris = $menus
        ->filter(fn ($menu) => $menu->kategori) // hanya menu yang punya kategori
        ->pluck('kategori')
        ->unique('id')
        ->values();

        return view('interface.menu', compact('menus','kategoris'));
    }

    public function gallery()
    {
        $galeris = Galeri::latest()->get(); // ambil semua data gallery
        return view('interface.gallery', compact('galeris'));
    }

    public function testimoni()
    {
        $testimonis = Testimoni::latest()->get(); // ambil semua testimoni
        return view('interface.testimoni', compact('testimonis'));
    }
}
