<?php

namespace App\Providers;

use App\Helpers\NepaliDate\src\NepaliDate;
use App\Models\Category;
use App\Models\Problem;
use App\Models\Project;
use App\Models\UserRecord;
use Illuminate\Support\Facades\View;
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
        $timezone = config('app.timezone', 'Asia/Kathmandu');
        NepaliDate::setDefaultTimeZoneName($timezone);
        if (class_exists(\Carbon\Carbon::class)) {
            \Carbon\Carbon::macro('toNepaliDate', function (): string {
                return NepaliDate::fromAd($this->toDateTime());
            });
        }

        View::composer(['errors.add', 'errors.edit'], function($view){
            $view->with([
                'users' => UserRecord::orderBy('first_name')->get(['id', 'first_name', 'last_name']),
                'projects' => Project::orderBy('project_name')->get(['id', 'project_name']),
                'problems' => Problem::orderBy('name')->get(['id','name']),
                'categories' => Category::orderBy('name')->get(['id', 'name'])
            ]);
        });
    }
}
