<?php

namespace App\Repositories\Api;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll()
    {
        $applications = Application::all();
        if($applications->isEmpty()){
            return 'No application added yet';
        }
        return $applications;
    }

    public function getById( int $id)
    {
        return Application::findOrFail($id);
    }

    public function create(array $data)
    {
        Application::create($data);
        return 'Application created successfully';
    }

    public function update(int $id, array $data)
    {
        $application = Application::findOrFail($id);
        $application->update($data);
        return 'Application updated successfully';
    }

    public function delete(int $id)
    {
        Application::destroy($id);
        return 'Application deleted successfully';
    }
}