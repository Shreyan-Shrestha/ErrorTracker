<?php

namespace App\Repositories\Api;

use App\Models\Application;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Category::latest()->paginate(10);
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

    public function delete(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
