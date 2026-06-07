<?php

namespace App\Repositories\Api;

use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll(): Collection
    {
        return Application::all();
    }

    public function getById(int $id): Application
    {
        return  Application::findOrFail($id);
    }

    public function create(array $data): Application
    {
        $app = Application::create($data);
        return $app->toArray();
    }

    public function update(int $id, array $data): Application
    {
        $application = Application::findOrFail($id);
        $application->update($data);
        return $application->toArray();
    }

    public function delete(int $id): Response
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return $application->toArray();
    }
}
