<?php

namespace App\Providers;

use App\Repositories\Api\ProjectRepository as ApiProjectRepository;
use App\Repositories\Api\ApplicationRepository as ApiApplicationRepository;
use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\ErrorTrackerRepository;
use App\Repositories\Api\ProblemRepository;
use App\Repositories\Api\UserRecordRepository;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;

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
        $this->app->bind(UserRecordRepositoryInterface::class, UserRecordRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
