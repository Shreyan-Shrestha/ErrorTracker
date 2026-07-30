<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRecordRequest;
use App\Models\UserRecord;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserRecordsController extends Controller
{
    protected UserRecordRepositoryInterface $user_record_repository;

    public function __construct(UserRecordRepositoryInterface $user_record_repository)
    {
        $this->user_record_repository = $user_record_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $userrecords = $this->user_record_repository->getAll();
        return view('userrecords.index', compact('userrecords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRecordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->user_record_repository->create($validated);
        return back()->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRecord $userRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRecordRequest $request, UserRecord $user): RedirectResponse
    {
        $validated = $request->validated();
        $this->user_record_repository->update($validated, $user);
        return back()->with('success', 'User Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRecord $user): RedirectResponse
    {
        $this->user_record_repository->destroy($user);
        return back()->with('success', 'User Removed Successfully');
    }
}
