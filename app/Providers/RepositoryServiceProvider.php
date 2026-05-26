<?php

namespace App\Providers;

use App\Repositories\Api\ProjectRepository as ApiProjectRepository;
use App\Repositories\Api\ApplicationRepository as ApiApplicationRepository;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ApiProjectRepository::class);
        $this->app->bind(ApplicationRepositoryInterface::class, ApiApplicationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
