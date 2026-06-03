<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : array
    {
        return Problem::all()->toArray();
    }

    public function getById(int $id) : array
    {
        return Problem::findOrFail($id)->toArray;
    
    }

    public function create(array $data) : array
    {
        return Problem::create($data)->toArray();
    }

    public function update(int $id, array $data) : array
    {
        $problem = Problem::findorfail($id);
        $problem->update($data);
        return $problem->toArray();
    }

    public function destroy(int $id) : array
    {
        $problem = Problem::findorfail($id);
        $problem->delete;
        return $problem->toArray();
    }
}
