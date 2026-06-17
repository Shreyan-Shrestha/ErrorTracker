<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\ErrorTrackerRequest;
use App\Models\ErrorTracker;
use Illuminate\Pagination\LengthAwarePaginator;

interface ErrorTrackerRepositoryInterface
{
    public function getall(): LengthAwarePaginator;
    public function create(ErrorTrackerRequest $request): void;
    public function show(int $id): Errortracker;
    public function update(ErrorTrackerRequest $request, ErrorTracker $error): void;
    public function markFixed(int $id): void;
    public function delete(ErrorTracker $error): void;
}
