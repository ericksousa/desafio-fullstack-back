<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
