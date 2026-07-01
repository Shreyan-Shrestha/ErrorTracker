<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;


class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Project::latest()->paginate(5);
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

    private function getActive(): int
    {
        return Project::where('status', ProjectStatus::Ongoing)->count();        
    }

    private function getCompletion(): int
    {
        $count = Project::count();
        if($count === 0) return 0;

        $completed = Project::where('status', ProjectStatus::Completed)->count();
        return round(($completed/$count)*100, 0);
    }

    private function getReview(): int
    {
        return Project::where('status', ProjectStatus::In_Review)->count();
    }
}
