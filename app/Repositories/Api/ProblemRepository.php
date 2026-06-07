<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : Collection
    {
        return Problem::all();
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
