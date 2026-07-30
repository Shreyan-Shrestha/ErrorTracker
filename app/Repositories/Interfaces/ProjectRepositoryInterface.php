<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function getProjectList(): Collection;
    public function getUsers() : Collection;
    public function show(int $id): Project;
    public function create(array $data): void;
    public function update(array $data, Project $project): void;
    public function updateStatus(Project $project): void;
    public function delete(Project $project): void;
    public function getStats(): array;
}
