<?php

namespace App\Repositories\Api;

use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Support\Collection;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll(): Collection
    {
        return Application::all();
    }

    public function getById(int $id): Application
    {
        return Application::findOrFail($id);
    }

    public function create(array $data): void
    {
        Application::create($data);
    }

    public function update(int $id, array $data): void
    {
        $application = Application::findOrFail($id);
        $application->update($data);
    }

    public function delete(int $id): void
    {
        Application::destroy($id);
    }
}
