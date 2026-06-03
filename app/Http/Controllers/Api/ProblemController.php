<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProblemRequest;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Http\JsonResponse;
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
    public function index(): JsonResponse
    {
        return ApiResponse::success('Problem records retrieved successfully', 200, $this->problemRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProblemRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return ApiResponse::success('Problem record created successfully', 201, $this->problemRepository->create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return ApiResponse::success('Problem record retrieved successfully', 200, $this->problemRepository->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        return ApiResponse::success('Problem record id: ' . $id . ' updated successfully', 200, $this->problemRepository->update($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return ApiResponse::success('Problem record ' . $id . ' deleted successfully', 200, $this->problemRepository->destroy($id));
    }
}
