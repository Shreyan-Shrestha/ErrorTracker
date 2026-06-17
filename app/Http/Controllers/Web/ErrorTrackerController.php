<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ErrorTracker;
use App\Http\Requests\ErrorTrackerRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;

class ErrorTrackerController extends Controller
{
    protected ErrorTrackerRepositoryInterface $error_tracker_repository;

    public function __construct(ErrorTrackerRepositoryInterface $error_tracker_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View | RedirectResponse
    {
       $errorsdata = $this->error_tracker_repository->getall();
       return view('errors.index', compact('errorsdata'));
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
       $this->error_tracker_repository->create($request);
        return redirect()->route('errors.index')->with('status', 'Error reported succesfully');
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
    public function update(ErrorTrackerRequest $request, ErrorTracker $error)
    {
        $this->error_tracker_repository->update($request, $error);
        return redirect()->route('errors.index')->with('status', 'Error Report updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorTracker $error)
    {
        $this->error_tracker_repository->delete($error);
        return redirect()->route('errors.index')->with('status','Error record deleted successfully');
    }
}
