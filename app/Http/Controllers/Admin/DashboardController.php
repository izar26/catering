<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data yang kita butuhkan untuk dashboard
        $jumlahProduk = Produk::count();
        $jumlahKategori = Kategori::count();
        $jumlahTestimoni = Testimoni::count();
        
        // Ambil 5 produk & testimoni terbaru untuk ditampilkan di widget
        $produkTerbaru = Produk::with('kategori')->latest()->take(5)->get();
    $testimoniTerbaru = Testimoni::latest()->take(5)->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'jumlahProduk', 
            'jumlahKategori',
            'jumlahTestimoni',
            'produkTerbaru',
            'testimoniTerbaru'
        ));
    }
}