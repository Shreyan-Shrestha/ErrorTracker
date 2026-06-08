<?php

declare(strict_types=1);

namespace App\Helpers\NepaliDate\src\Laravel;

use App\Helpers\NepaliDate\src\NepaliDate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
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
        $timezone = config('app.timezone', 'Asia/Kathmandu');
        NepaliDate::setDefaultTimeZoneName($timezone);
        if (class_exists(\Carbon\Carbon::class)) {
            \Carbon\Carbon::macro('toNepaliDate', function (): string {
                return NepaliDate::fromAd($this->toDateTime())->toDateTimeString();
            });
        }
    }
}
