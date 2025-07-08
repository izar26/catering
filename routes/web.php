<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProfilPerusahaanController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\InfoPemesananController;
use App\Http\Controllers\InterfaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [InterfaceController::class, 'beranda'])->name('beranda');
Route::get('/menu', [InterfaceController::class, 'menu'])->name('menu');
Route::get('/galeri/foto', [InterfaceController::class, 'galeriFoto'])->name('galeri.foto');
Route::get('/galeri/video', [InterfaceController::class, 'galeriVideo'])->name('galeri.video');
Route::get('/testimoni', [InterfaceController::class, 'testimoni'])->name('testimoni');
Route::get('/kontak', fn() => view('interface.kontak'))->name('kontak');
Route::get('/testimoni-form', fn() => view('interface.testimoni-form'))->name('testimoni-form');
Route::get('/paket-buffet', [InterfaceController::class, 'paketBuffet']);
Route::get('/pencarian-redirect', [InterfaceController::class, 'footerSearch'])->name('footer.search');
Route::post('/testimoni-form', [TestimoniController::class, 'store'])->name('testimoni.store');

// Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- GRUP RUTE ADMIN ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::post('/', [KategoriController::class, 'store'])->name('store');
        Route::get('/{kategori}/edit', [KategoriController::class, 'index'])->name('edit'); 
        Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    Route::resource('produk', ProdukController::class);
    Route::get('profil-perusahaan', [ProfilPerusahaanController::class, 'edit'])->name('profil.edit');
    Route::put('profil-perusahaan', [ProfilPerusahaanController::class, 'update'])->name('profil.update');
    
    Route::prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('index');
        Route::post('/', [GaleriController::class, 'store'])->name('store');
        Route::put('/{galeri}', [GaleriController::class, 'update'])->name('update');
        Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('testimoni')->name('testimoni.')->group(function () {
    Route::get('/', [TestimoniController::class, 'index'])->name('index');
    Route::post('/', [TestimoniController::class, 'store'])->name('store');
    Route::get('/{testimoni}/edit', [TestimoniController::class, 'index'])->name('edit');
    Route::put('/{testimoni}', [TestimoniController::class, 'update'])->name('update');
    Route::delete('/{testimoni}', [TestimoniController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/toggle', [TestimoniController::class, 'toggleTampilkan'])->name('toggle');
});


Route::get('info-pemesanan', [InfoPemesananController::class, 'edit'])->name('info.pemesanan.edit');
Route::put('info-pemesanan', [InfoPemesananController::class, 'update'])->name('info.pemesanan.update');

Route::get('ganti-password', [AuthController::class, 'showGantiPassword'])->name('password.form');
Route::post('ganti-password', [AuthController::class, 'gantiPassword'])->name('password.update');

});