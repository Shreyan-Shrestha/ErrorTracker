<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : LengthAwarePaginator
    {
        return Problem::latest()->paginate(10);
    }

    public function getById(int $id) : Problem
    {
        return Problem::findOrFail($id);
    
    }

    public function create(array $data): void
    {
        Problem::create($data);
    }

    public function update(array $data, Problem $problem) : void
    {
        $problem->update($data);
    }

    public function destroy(Problem $problem) : void
    {
        $problem->delete;
    }
}
