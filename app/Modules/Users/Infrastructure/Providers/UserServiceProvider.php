<?php

namespace App\Modules\Users\Infrastructure\Providers;


use Illuminate\Support\ServiceProvider;
use Route;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            \App\Modules\Users\Domain\Interfaces\UserInterface::class,
            \App\Modules\Users\Infrastructure\Repository\UserRepository::class
        );
        
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
