<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Yeh line add ki gayi hai

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
        // Agar website local computer par nahi hai, toh HTTPS lazmi use kare
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
