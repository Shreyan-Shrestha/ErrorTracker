<?php

namespace App\Repositories\Api;

use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Application::latest()->paginate(10);
    }

    public function getById(int $id): Application
    {
        return  Application::findOrFail($id);
    }

    public function create(array $data): Application
    {
        $app = Application::create($data);
        return $app;
    }

    public function update(int $id, array $data): Application
    {
        $application = Application::findOrFail($id);
        $application->update($data);
        return $application;
    }

    public function delete(int $id): Response
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return response()->noContent();
    }
}
