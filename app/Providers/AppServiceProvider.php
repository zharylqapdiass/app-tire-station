<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TireServiceRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(TireServiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
