<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): array
    {
        return Project::all()->toArray();
    }

    public function create(array $data): array
    {
        return Project::create($data)->toArray();
    }

    public function show(int $id): array
    {
        return Project::findOrFail($id)->toArray();
    }

    public function update(int $id, array $data): array
    {
        $project = Project::findOrFail($id);
        return $project->update($data)->toArray();
    }

    public function updateStatus(int $id, string $status): array
    {
        $project = Project::findOrFail($id);
        if ($status !== $project->enum('status', ProjectStatus::class)) {
            $project->status = $status;
            return $project->save()->toArray();
        }
        return $project->toArray();
    }

    public function delete(int $id): array
    {
        $project = Project::findOrFail($id);
        return $project->delete()->toArray();
    }
}
