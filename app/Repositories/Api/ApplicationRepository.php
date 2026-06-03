<?php

namespace App\Repositories\Api;

use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll(): array
    {
        return Application::all()->toArray();
    }

    public function getById(int $id): array
    {
        return  Application::findOrFail($id)->toArray();
    }

    public function create(array $data): array
    {
        $app = Application::create($data);
        return $app->toArray();
    }

    public function update(int $id, array $data): array
    {
        $application = Application::findOrFail($id);
        $application->update($data);
        return $application->toArray();
    }

    public function delete(int $id): array
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return $application->toArray();
    }
}
