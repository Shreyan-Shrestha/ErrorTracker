<?php

namespace App\Repositories\Api;

use App\Models\ErrorReport;
use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : LengthAwarePaginator
    {
        return ErrorReport::with(['problem', 'category'])
        ->orderBySeverity()
        ->paginate(10);
    }

    public function getAllCount(): int
    {
        return Problem::count();
    }

    public function getById(int $id) : Problem
    {
        return Problem::with('errorReports')->findOrFail($id);
    
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
        $problem->delete();
    }
}
