<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : LengthAwarePaginator
    {
        return Problem::latest()->paginate();
    }

    public function getById(int $id) : Problem
    {
        return Problem::findOrFail($id);
    
    }

    public function create(array $data) : Problem
    {
        return Problem::create($data);
    }

    public function update(int $id, array $data) : Problem
    {
        $problem = Problem::findorfail($id);
        $problem->update($data);
        return $problem;
    }

    public function destroy(int $id) : Response
    {
        $problem = Problem::findorfail($id);
        $problem->delete;
        return response()->noContent();
    }
}
