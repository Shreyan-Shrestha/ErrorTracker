<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): Collection
    {
        return Project::all();
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function show(int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function update(int $id, array $data): Project
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function updateStatus(int $id, string $status): Project
    {
        $project = Project::findOrFail($id);
        $project->status = $status;
        return $project;
    }

    public function delete(int $id): Response
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->noContent();
    }
}
