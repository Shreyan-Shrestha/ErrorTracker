<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Project::latest()->paginate(5);
    }

    public function getProjects(): Collection
    {
        return Project::orderBy('project_name', 'asc')
        ->get(['id', 'project_name']);
    }

    public function create(array $data): void
    {
        Project::create($data);
    }

    public function show(int $id): Project
    {
        return Project::findorfail($id);
    }

    public function update(array $data, Project $project): void
    {
        $project->update($data);
    }

    public function updateStatus(Project $project): void
    {
        $project->status = ProjectStatus::Completed;
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

    public function getActive(): int
    {
        return Project::where('status', ProjectStatus::Ongoing)->count();        
    }

    public function getCompletion(): int
    {
        $completed = count(Project::where('status', ProjectStatus::Completed)->get()->toArray());
        $count = count(Project::all()->toArray());
        return ($completed/$count)*100;
    }

    public function getReview(): int
    {
        return count(Project::where('status', ProjectStatus::In_Review)->get());
    }
}
