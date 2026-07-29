<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected CategoryRepositoryInterface $category_repository;

    public function __construct(CategoryRepositoryInterface $category_repository)
    {
        $this->category_repository = $category_repository;   
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $this->category_repository->create($validated);
        return back()->with('success', 'Problem Category Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->category_repository->delete($category);
        return back()->with('success', 'Problem Category Removed Successfully.');
    }
}
