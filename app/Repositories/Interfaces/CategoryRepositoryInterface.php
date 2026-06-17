<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function show(int $id): Category;
    public function create(array $data): void;
    public function update(array $data, Category $category): void;
    public function delete(int $id): void;
}
