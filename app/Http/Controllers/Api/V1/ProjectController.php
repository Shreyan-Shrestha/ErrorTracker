<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

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
    public function index(): JsonResponse
    {
        return Response::success($this->projectRepository->getAll());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = strtolower($validated['status']);
        return Response::success($this->projectRepository->create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return Response::success($this->projectRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = strtolower($validated['status']);
        return Response::success($this->projectRepository->update($id, $validated));
    }

    /**     * Update the specified resource in storage.
     */
    public function updateStatus(ProjectRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        return Response::success($this->projectRepository->updateStatus($id, $validated['status'] ?? ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        return Response::success($this->projectRepository->delete($project->id));
    }
}
