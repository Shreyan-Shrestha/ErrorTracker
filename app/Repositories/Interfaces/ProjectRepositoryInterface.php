<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAll(): array;
    public function show(int $id): array;
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function updateStatus(int $id, string $status): array;
    public function delete(int $id): array;
}
