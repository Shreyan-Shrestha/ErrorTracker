<?php

namespace App\Repositories\Interfaces;

interface ErrorTrackerRepositoryInterface
{
    public function getall(): array;
    public function create(array $data): array;
    public function show(int $id): array;
    public function update(int $id, array $data): array;
    public function markFixed(int $id): array;
    public function delete(int $id): array;
}
