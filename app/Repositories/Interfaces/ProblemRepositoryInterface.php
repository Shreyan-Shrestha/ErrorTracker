<?php

namespace App\Repositories\Interfaces;

use App\Models\Problem;

interface ProblemRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function destroy(int $id);
}
