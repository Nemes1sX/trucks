<?php

namespace App\Providers;

use App\Interfaces\ITruckService;
use App\Services\TruckService;
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
    public function boot(): void
    {
        $this->app->bind(ITruckService::class, TruckService::class);
    }
}
