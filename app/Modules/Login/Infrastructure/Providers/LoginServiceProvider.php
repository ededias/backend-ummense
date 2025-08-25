<?php

namespace App\Modules\Login\Infrastructure\Providers;


use Illuminate\Support\ServiceProvider;
use Route;

class LoginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
