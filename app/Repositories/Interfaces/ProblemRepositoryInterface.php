<?php

namespace App\Repositories\Interfaces;

use App\Models\Problem;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProblemRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function getById(int $id): Problem;
    public function create(array $data): Problem;
    public function update(int $id, array $data): Problem;
    public function destroy(int $id): Response;
}
