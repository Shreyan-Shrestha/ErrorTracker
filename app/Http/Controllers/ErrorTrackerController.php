<?php

namespace App\Http\Controllers;

use App\Models\ErrorTracker;
use App\Http\Requests\ErrorTrackerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ErrorTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = ErrorTracker::latest()->first();
        return view('welcome', compact('now'));
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
    public function store(ErrorTrackerRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        ErrorTracker::create($validated);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(ErrorTracker $errorTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorTracker $errorTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ErrorTracker $errorTracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorTracker $errorTracker)
    {
        //
    }
}
