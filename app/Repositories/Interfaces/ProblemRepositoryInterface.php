<?php

namespace App\Repositories\Interfaces;

use App\Models\Problem;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProblemRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function getLogCount(): int;
    public function getById(int $id): Problem;
    public function create(array $data): void;
    public function update(array $data, Problem $problem): void;
    public function destroy(Problem $problem): void;
}
