<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
    public function show(int $id): Category;
    public function create(array $data): void;
    public function update(array $data, Category $category): void;
    public function delete(Category $category): void;
}
