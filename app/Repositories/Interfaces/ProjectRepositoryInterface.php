<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function show(int $id): Project;
    public function create(ProjectRequest $request): void;
    public function update(ProjectRequest $request, Project $project): void;
    public function updateStatus(Project $project): void;
    public function delete(Project $project): void;
}
