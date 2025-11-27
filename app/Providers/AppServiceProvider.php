<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
     public function boot()
    {
        Paginator::useBootstrapFour(); // Para Bootstrap 5
        // O si usas Bootstrap 4:
        // Paginator::useBootstrapFour();
    }
}
