<?php

namespace App\Repositories\Interfaces;

use App\Models\Problem;

interface ProblemRepositoryInterface
{
    public function getAll() : array ;
    public function getById(int $id) : array ;
    public function create(array $data) : array ;
    public function update(int $id, array $data) : array ;
    public function destroy(int $id) : array ;
}
