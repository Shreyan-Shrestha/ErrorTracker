<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\ErrorReport;
use App\Http\Requests\Web\ErrorReportRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use Exception;
use RuntimeException;

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
        $users = $this->error_tracker_repository->getUsers();
        return view('errors.index', compact('stats', 'errorsdata', 'logCount', 'users'));
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
        try{
            $this->error_tracker_repository->create($validated);
            return redirect()->route('errors.index')->with('success', 'Error reported succesfully');
        }catch(RuntimeException $e){
            return back()->withInput()->with('error', 'Document upload failed. Please try again later.');
        }
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
        try{
            $this->error_tracker_repository->update($validated, $error);
            return redirect()->route('errors.index')->with('success', 'Error Report updated sucessfully');
        } catch (Exception $e){
            return back()->withInput()->with('error', 'File upload failed. Please try again later.');
        }    
    }

    public function assign(ErrorReportRequest $request, ErrorReport $error): RedirectResponse
    {
        $validated = $request->validated();
        $this->error_tracker_repository->assignError($validated, $error);
        return redirect()->route('errors.index')->with('success', 'Error assigned to the developer');
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
