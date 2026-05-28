<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): Collection
    {
        return Project::all();
    }

    public function create(array $data): void
    {
        Project::create($data);
    }

    public function show(int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function update(int $id, array $data): void
    {
        $project = Project::findOrFail($id);
        $project->update($data);
    }

    public function updateStatus(int $id, string $status): void
    {
        $project = Project::findOrFail($id);
        if ($status !== $project->enum('status', ProjectStatus::class)) {
            $project->status = $status;
            $project->save();
        }
    }

    public function delete(int $id): void
    {
        Project::destroy($id);
    }
}
