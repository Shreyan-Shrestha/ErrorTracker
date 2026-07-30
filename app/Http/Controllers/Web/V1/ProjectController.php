<?php

namespace App\Http\Controllers\Web\V1;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ProjectController extends Controller
{
    protected ProjectRepositoryInterface $project_repository;

    public function __construct(ProjectRepositoryInterface $project_repository)
    {
        $this->project_repository = $project_repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = $this->project_repository->getAll();
        $projects_list = $this->project_repository->getProjectList();
        $users= $this->project_repository->getUsers();
        $stats = $this->project_repository->getStats();
        return view('projects/index', compact('projects', 'users', 'stats', 'projects_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        $this->project_repository->create($validated);
        return back()->with('success','Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Project
    {
        return $this->project_repository->show($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        $this->project_repository->update($validated, $project);
        return back()->with('success', 'Project Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->project_repository->delete($project);
        return back()->with('success','Project deleted successfully');
    }
}
