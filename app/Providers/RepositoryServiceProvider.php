<?php

namespace App\Providers;

use App\Repositories\Api\ProjectRepository as ApiProjectRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectRepository;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ApiProjectRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
