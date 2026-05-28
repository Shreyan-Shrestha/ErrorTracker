<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    protected ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface  $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->projectRepository->getAll());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = strtolower($validated['status']);
        return response()->json($this->projectRepository->create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : JsonResponse 
    {
        return response()->json($this->projectRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, int $id) : JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = strtolower($validated['status']);
        return response()->json($this->projectRepository->update($id, $validated));
    }

    /**     * Update the specified resource in storage.
     */
    public function updateStatus(ProjectRequest $request, int $id) : JsonResponse
    {
        $validated = $request->validated();

        if (isset($validated['status'])) {
            $validated['status'] = strtolower($validated['status']);
        }

        return response()->json($this->projectRepository->updateStatus($id, $validated['status'] ?? ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project) : JsonResponse
    {
        $this->projectRepository->delete($project->id);
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
