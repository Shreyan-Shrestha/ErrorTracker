<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function getProjects(): Collection;
    public function show(int $id): Project;
    public function create(array $data): void;
    public function update(array $data, Project $project): void;
    public function updateStatus(Project $project): void;
    public function delete(Project $project): void;
    public function getStats(): array;
    public function getActive(): int;
    public function getCompletion():int;
    public function getReview(): int;
}
