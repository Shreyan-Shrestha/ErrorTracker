<?php

namespace App\Repositories\Interfaces;

interface ErrorTrackerRepositoryInterface
{
    public function getall();
    public function create(array $data);
    public function show(int $id);
    public function update(int $id,array $data);
    public function delete(int $id);
}
