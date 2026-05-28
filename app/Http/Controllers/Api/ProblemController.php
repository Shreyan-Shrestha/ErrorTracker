<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProblemRequest;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    protected ProblemRepositoryInterface $problemRepository;
    
    public function __construct(ProblemRepositoryInterface $problemRepository)
    {
        $this->problemRepository->$problemRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->problemRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProblemRequest $request)
    {
        $validated = $request->validated();
        $this->problemRepository->create($validated);
        return response()->json('Stored successfully');
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
