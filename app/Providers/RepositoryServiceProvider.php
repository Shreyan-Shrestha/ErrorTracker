<?php

namespace App\Providers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;
use App\Repositories\Web\V1\CategoryRepository;
use App\Repositories\Web\V1\DashboardRepository;
use App\Repositories\Web\V1\ErrorReportRepository;
use App\Repositories\Web\V1\ProblemRepository;
use App\Repositories\Web\V1\ProjectRepository;
use App\Repositories\Web\V1\UserRecordRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ErrorReportRepositoryInterface::class, ErrorReportRepository::class);
        $this->app->bind(ProblemRepositoryInterface::class, ProblemRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(UserRecordRepositoryInterface::class, UserRecordRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
