<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Galeri;
use App\Models\ProfilPerusahaan;
use App\Models\Testimoni;
use App\Models\InfoPemesanan;

class InterfaceController extends Controller
{
    public function beranda()
{
    $profil = ProfilPerusahaan::find(1); 
    $produkUnggulan = Produk::where('is_unggulan', 1)->get();
    $produkPrevent = Produk::where('tipe', 'prevent')->get();
    $paketans = Produk::where('tipe', 'paketan')->get();
    $info = InfoPemesanan::first();
    $video = Galeri::where('tipe', 'video')->latest()->first();

    // Ambil nomor WA pertama dari string no_wa yang dipisah koma
    $firstNo = null;
    if ($profil && $profil->no_wa) {
        $nomorArray = explode(',', $profil->no_wa);
        $firstNo = trim($nomorArray[0]);
    }

    return view('interface.beranda', compact('profil', 'produkUnggulan', 'produkPrevent', 'paketans', 'info', 'video', 'firstNo'));
}


    public function menu()
    {
        // Ambil semua produk bertipe 'satuan' dan relasi kategorinya
        $menus = Produk::with('kategori')
            ->where('tipe', 'satuan')
            ->where('is_unggulan', 0) // Hanya ambil produk yang tidak unggulan
            ->get();

        // Ambil daftar kategori unik dari produk yang sudah difilter
        $kategoris = $menus
            ->filter(fn ($menu) => $menu->kategori)
            ->pluck('kategori')
            ->unique('id')
            ->values();

        return view('interface.menu', compact('menus', 'kategoris'));
    }


    public function galeriFoto()
    {
        $galeris = Galeri::where('tipe', 'foto')->latest()->get();
        return view('interface.galeri-foto', compact('galeris'));
    }

    public function galeriVideo()
    {
        $galeris = Galeri::where('tipe', 'video')->latest()->get();
        return view('interface.galeri-video', compact('galeris'));
    }


    public function testimoni()
    {
        $testimonis = Testimoni::latest()->get(); // ambil semua testimoni
        return view('interface.testimoni', compact('testimonis'));
    }

    public function footerSearch(Request $request)
    {
        $keyword = strtolower(trim($request->q));

        $routes = [
            'home'      => '/',
            'beranda'   => '/',
            'about'     => '/#about',
            'tentang'   => '/#about',
            'spesial'  => '/#specials',
            'unggulan'  => '/#specials',
            'prevent'   => '/#preventif',
            'preventif' => '/#preventif',
            'paketan'   => '/#paket',
            'paket buffet' => '/#paket',
            'paket'     => '/#paket',
            'menu'      => '/menu',
            'gallery foto' => '/galeri/foto',
            'foto'      => '/galeri/foto',
            'gallery video' => '/galeri/video',
            'video'     => '/galeri/video',
            'testimoni' => '/testimoni',
            'testimoni-form' => '/testimoni-form',
            'kontak'    => '/kontak',
        ];


        if (array_key_exists($keyword, $routes)) {
            return redirect($routes[$keyword]);
        }

        // Kalau kata tidak ditemukan, redirect ke halaman utama atau tampilkan pesan
        return redirect('/')->with('notfound', 'Halaman tidak ditemukan untuk kata: ' . $keyword);
    }
}
