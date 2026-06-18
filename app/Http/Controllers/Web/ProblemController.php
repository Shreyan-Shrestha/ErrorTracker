<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProblemRepositoryInterface;

class ProblemController extends Controller
{
    protected ProblemRepositoryInterface $problem_repository;

    public function __construct(ProblemRepositoryInterface $problem_repository)
    {
        $this->problem_repository = $problem_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problems = $this->problem_repository->getAll();
        return view('problems.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
