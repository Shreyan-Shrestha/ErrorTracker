<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProblemRequest;
use App\Models\Problem;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProblemController extends Controller
{
    protected ProblemRepositoryInterface $problem_repository;
    protected CategoryRepositoryInterface $category_repository;

    public function __construct(ProblemRepositoryInterface $problem_repository, CategoryRepositoryInterface $category_repository)
    {
        $this->problem_repository = $problem_repository;
        $this->category_repository = $category_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $errorReports =  $this->problem_repository->getAll();
        $logCount     =  $this->problem_repository->getLogCount();
        $categories   =  $this->category_repository->getAll();
        $data         =  $this->category_repository->getChart();
        return view('problems.index', compact('errorReports', 'categories', 'logCount', 'data'));
    }

    public function problemLogs(): View
    {
        $errorReports = $this->problem_repository->getAll();
        return view('problems.logs', compact('errorReports'));
    }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProblemRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->problem_repository->create($validated);
        return back()->with(['success', 'Problem created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProblemRequest $request, Problem $problem): RedirectResponse
    {
        $validated = $request->validated();
        $this->problem_repository->update($validated, $problem);
        return back()->with('success', 'Problem record edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem): RedirectResponse
    {
        $this->problem_repository->destroy($problem);
        return back()->with('success', 'Problem record deleted successfully');
    }
}
