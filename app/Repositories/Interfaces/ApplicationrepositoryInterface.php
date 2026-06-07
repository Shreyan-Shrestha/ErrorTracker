<?php

namespace App\Repositories\Interfaces;

use App\Models\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

interface ApplicationRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Application;
    public function create(array $data): Application;
    public function update(int $id, array $data): Application;
    public function delete(int $id): Response;
}
