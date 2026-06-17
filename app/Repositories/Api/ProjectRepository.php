<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Project::latest()->paginate();
    }

    public function create(ProjectRequest $request): void
    {
        $validated = $request->validated();
        Project::create($validated);
    }

    public function show(int $id): Project
    {
        return Project::findorfail($id);
    }

    public function update(ProjectRequest $request, Project $project): void
    {
        $validated = $request->validated();
        $project->update($validated);
    }

    public function updateStatus(Project $project): void
    {
        $project->status = ProjectStatus::Completed;
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
