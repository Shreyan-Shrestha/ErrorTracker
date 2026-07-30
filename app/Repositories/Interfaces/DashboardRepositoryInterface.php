<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface DashboardRepositoryInterface
{
    public function getCriticalErrors(): LengthAwarePaginator;
    public function getErrorTrend(): array;
    public function getErrorByRegion() : array;
    public function getErrorsByProject(): array;
    public function getStats(): array;
}
