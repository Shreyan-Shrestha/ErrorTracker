<?php

namespace App\Repositories\Api;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::latest()->get();
    }

    public function show(int $id): Category
    {
        return Category::findOrFail($id);
    }
    public function create(array $data): void
    {
        Category::create($data);
    }

    public function update(array $data, Category $category): void
    {
        $category->update($data);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
