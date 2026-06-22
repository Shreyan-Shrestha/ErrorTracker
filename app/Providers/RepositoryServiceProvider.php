<?php

namespace App\Providers;

use App\Repositories\Api\ProjectRepository as ApiProjectRepository;
use App\Repositories\Api\ApplicationRepository as ApiApplicationRepository;
use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\ErrorTrackerRepository;
use App\Repositories\Api\ProblemRepository;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
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
        $this->app->bind(ErrorTrackerRepositoryInterface::class, ErrorTrackerRepository::class);
        $this->app->bind(ProblemRepositoryInterface::class, ProblemRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
