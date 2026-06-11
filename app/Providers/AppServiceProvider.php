<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Memaksa Laravel menggunakan HTTPS dan mengabaikan port internal
        // agar link tidak tersangkut :8080
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    protected $proxies = '*'; // Ubah menjadi '*' untuk mempercayai semua proxy (Railway)
}