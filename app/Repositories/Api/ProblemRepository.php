<?php

namespace App\Repositories\Api;

use App\Models\Problem;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
class ProblemRepository implements ProblemRepositoryInterface
{
    public function getAll()
    {
        return Problem::all();
    }

    public function show(int $id)
    {
        $problem = Problem::findOrFail($id);
        return $problem;
    }

    public function create(array $data)
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
