<?php

namespace App\Repositories\Api;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Override;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAll()
    {
        return Project::all();
    }

    public function create(array $data)
    {
        Project::create($data);
        return 'Project created successfully';
    }

    public function show(int $id)
    {
        return Project::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return 'Project updated successfully';
    }

    public function updateStatus(int $id, string $status){
        $project = Project::findOrFail($id);
        if($status !== $project->enum('status',ProjectStatus::class)){
            $project->status = $status;
            $project->save();
        }
        return 'Status updated successfully';
    }

    public function delete(int $id)
    {
        Project::destroy($id);
        return 'Project deleted successfully';
    }
}
