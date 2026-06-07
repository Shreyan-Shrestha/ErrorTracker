<?php

namespace App\Repositories\Interfaces;

use App\Models\Problem;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

interface ProblemRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Problem;
    public function create(array $data): Problem;
    public function update(int $id, array $data): Problem;
    public function destroy(int $id): Response;
}
