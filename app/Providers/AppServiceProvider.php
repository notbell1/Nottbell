<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. Tambahkan ini di atas
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
    // Force HTTPS di Production
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }

    // PAKSA Laravel menggunakan folder /tmp untuk cache (Penting untuk Vercel)
    if (env('VERCEL')) {
        app()->useStoragePath('/tmp/storage');
        if (!is_dir('/tmp/storage/framework/views')) {
            mkdir('/tmp/storage/framework/views', 0755, true);
        }
    }
}
}