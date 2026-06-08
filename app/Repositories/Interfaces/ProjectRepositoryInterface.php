<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function show(int $id): Project;
    public function create(array $data): Project;
    public function update(int $id, array $data): Project;
    public function updateStatus(int $id, string $status): Project;
    public function delete(int $id): Response;
}
