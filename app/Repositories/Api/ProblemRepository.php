<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Support\Collection;

class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll() : Collection
    {
        return Problem::all();
    }

    public function show(int $id) : Problem
    {
        return Problem::findOrFail($id);
    
    }

    public function create(array $data) : void
    {
        Problem::create($data);
    }

    public function update(int $id, array $data) : void
    {
        $problem = Problem::findorfail($id);
        $problem->update($data);
    }

    public function destroy(int $id) : void
    {
        $problem = Problem::findorfail($id);
        $problem->delete;
    }
}
