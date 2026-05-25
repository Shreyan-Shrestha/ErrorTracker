<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use RateLimiter as GlobalRateLimiter;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        parent::boot();
    }

    protected function configureRateLimiting(): void
    {
        FacadesRateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(3)
                ->by($request->user()?->id ?: $request->ip());
        });

        FacadesRateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(6, 5)->by($request->ip());
        });
    }
}
