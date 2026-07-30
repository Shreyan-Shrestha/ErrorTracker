<?php

namespace App\Repositories\Web\V1;

use App\Models\Category;
use App\Models\ErrorReport;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::latest()->get();
    }

    public function getChart(): array
    {
        $results = ErrorReport::select('category_id', DB::raw('COUNT(*) as count'))
            ->with('category')
            ->groupBy('category_id')
            ->orderBy('count')
            ->limit(4)
            ->get();

        return [
            'labels' => $results->map(fn($r) => $r->category->name)->toArray(),
            'data'   => $results->map(fn($r) => $r->count)->toArray(),
        ];
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
