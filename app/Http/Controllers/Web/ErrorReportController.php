<?php

namespace App\Http\Controllers\Web;

use App\Enums\ErrorStatus;
use App\Http\Controllers\Controller;
use App\Models\ErrorReport;
use App\Http\Requests\Api\ErrorReportRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;

class ErrorReportController extends Controller
{
    protected ErrorReportRepositoryInterface $error_tracker_repository;

    public function __construct(ErrorReportRepositoryInterface $error_tracker_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $errorsdata = $this->error_tracker_repository->getall(4);
        $logCount = $this->error_tracker_repository->getAllCount();
        $stats = $this->error_tracker_repository->getStats();
        return view('errors.index', compact('stats', 'errorsdata', 'logCount'));
    }

    public function errorLogs(): View
    {
        $errorsdata = $this->error_tracker_repository->getall(4);
        return view('errors.logs', compact('errorsdata'));
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
    public function store(ErrorReportRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->error_tracker_repository->create($validated);
        return redirect()->route('errors.index')->with('success', 'Error reported succesfully');
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
    public function edit(ErrorReport $error): View
    {
        return view('errors.edit', compact('error'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ErrorReportRequest $request, ErrorReport $error): RedirectResponse
    {
        $validated = $request->validated();
        $this->error_tracker_repository->update($validated, $error);
        return redirect()->route('errors.index')->with('success', 'Error Report updated sucessfully');
    }

    public function analysis(ErrorReportRequest $request, ErrorReport $error): RedirectResponse
    {
        $validated = $request->validated();
        $this->error_tracker_repository->analysis($validated, $error);
        return redirect()->route('errors.index')->with('success', 'Root Cause Analysis updated successfully');
    }

    public function markFixed(ErrorReport $error): RedirectResponse
    {
        if(!empty($error->end_time)){
            return back()->with('error', 'Error Report is already marked as fixed at:'. $error->end_time);
        }

        if(empty($error->root_cause)){
            return redirect()->route('errors.index')->with('error', 'Please fill the Root Cause Analysis to mark the error as Fixed.');
        }

        $this->error_tracker_repository->markFixed($error);
        return redirect()->route('errors.index')->with('success', 'Error Report'. $error->problem->name .' marked as Fixed.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorReport $error): RedirectResponse
    {
        $this->error_tracker_repository->delete($error);
        return redirect()->route('errors.index')->with('success', 'Error record deleted successfully');
    }
}
