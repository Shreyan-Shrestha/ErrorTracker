<?php

namespace App\Repositories\Interfaces;

use App\Models\ErrorTracker;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface ErrorTrackerRepositoryInterface
{
    public function getall(): LengthAwarePaginator;
    public function create(array $data): ErrorTracker;
    public function show(int $id): Errortracker;
    public function update(int $id, array $data): ErrorTracker;
    public function markFixed(int $id): ErrorTracker;
    public function delete(int $id): Response;
}
