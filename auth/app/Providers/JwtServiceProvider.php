<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\JwtService;
use Illuminate\Support\ServiceProvider;

class JwtServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JwtService::class);
    }

    public function boot(): void
    {
        //
    }
}
