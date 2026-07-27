<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\UserRecord;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Project::latest()->with(['user', 'subProjects'])->paginate(5);
    }

    public function getProjectList(): Collection
    {
        return Project::orderBy('project_name')->get(['id', 'project_name']);
    }

    public function create(array $data): void
    {
        $subProjects = $data['sub_projects'] ?? [];
        unset($data['sub_projects']);

        $project = Project::create($data);
        if (!empty($subProjects)) {
            $project->subProjects()->sync($subProjects);
        }
    }

    public function getUsers(): Collection
    {
        return UserRecord::select('id', 'first_name', 'last_name')
        ->orderBy('first_name', 'asc')
        ->get();
    }

    public function show(int $id): Project
    {
        return Project::with('subProjects')->findorfail($id);
    }

    public function update(array $data, Project $project): void
    {
        $subProjects = $data['sub_projects'] ?? [];
        unset($data['sub_projects']);
        $project->update($data);
        $project->subProjects()->sync($subProjects);
    }

    public function updateStatus(Project $project): void
    {
        $project->status = ProjectStatus::Completed;
        $project->save();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }

    public function getStats(): array
    {
        return [
            "active" => $this->getActive(),
            "completion" => $this->getCompletion(),
            "review" => $this->getReview()
        ];
    }

    private function getActive(): int
    {
        return Project::where('status', ProjectStatus::Ongoing->value)->count();
    }

    private function getCompletion(): int
    {
        $count = Project::count();
        if ($count === 0) return 0;

        $completed = Project::where('status', ProjectStatus::Completed->value)->count();
        return round(($completed / $count) * 100, 0);
    }

    private function getReview(): int
    {
        return Project::where('status', ProjectStatus::In_Review->value)->count();
    }
}
