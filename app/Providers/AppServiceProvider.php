<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ✅ Benar
use App\Models\ProfilPerusahaan;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan data profil ke semua view yang diawali dengan "interface."
        View::composer('*', function ($view) {
            $view->with('profil', ProfilPerusahaan::first());
        });
    }
}
