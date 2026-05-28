<?php

namespace App\Repositories\Api;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll()
    {
        return Application::all();
    }

    public function getById( int $id)
    {
        $app = Application::findOrFail($id);
        return $app;
    }

    public function create(array $data)
    {
        Application::create($data);
    }

    public function update(int $id, array $data)
    {
        $application = Application::findOrFail($id);
        $application->update($data);
    }

    public function delete(int $id)
    {
        Application::destroy($id);
    }
}