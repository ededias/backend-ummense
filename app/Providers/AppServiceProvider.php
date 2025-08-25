<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
       
        $this->app->register(\App\Modules\Users\Infrastructure\Providers\UserServiceProvider::class);
        $this->app->register(\App\Modules\Login\Infrastructure\Providers\LoginServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
