<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ErrorReport;
use App\Http\Requests\Api\ErrorReportRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ErrorReportController extends Controller
{
    protected ErrorReportRepositoryInterface $error_tracker_repository;
    protected ProjectRepositoryInterface $project_repository;

    public function __construct(ErrorReportRepositoryInterface $error_tracker_repository, ProjectRepositoryInterface $project_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
        $this->project_repository = $project_repository;
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
        return view('errors.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ErrorReportRequest $request) : RedirectResponse
    {
       $this->error_tracker_repository->create($request);
        return back()->with('success', 'Error reported succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ErrorReport $errorReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorReport $errorReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ErrorReportRequest $request, ErrorReport $error)
    {
        $this->error_tracker_repository->update($request, $error);
        return back()->with('success', 'Error Report updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorReport $error)
    {
        $this->error_tracker_repository->delete($error);
        return back()->with('success','Error record deleted successfully');
    }
}
