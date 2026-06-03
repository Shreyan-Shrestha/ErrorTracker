<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ErrorTrackerRequest;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ErrorTrackerController extends Controller
{
    protected ErrorTrackerRepositoryInterface $error_tracker_repository;

    public function __construct(ErrorTrackerRepositoryInterface $error_tracker_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
    }

    public function index(): JsonResponse
    {
        return ApiResponse::success('Error Reports retireved successfully', 200, $this->error_tracker_repository->getall());
    }

    public function store(ErrorTrackerRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return ApiResponse::success('Error Reported Successfully', 201, $this->error_tracker_repository->create($validated));
    }

    public function show(string $id): JsonResponse
    {
        return ApiResponse::success('Error Report retrieved successfully', 200, $this->error_tracker_repository->show($id));
    }

    public function update(ErrorTrackerRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        return ApiResponse::success('Error Report updated successfully', 200, $this->error_tracker_repository->update($id, $validated));
    }

    public function markFixed(int $id): JsonResponse
    {
        return ApiResponse::success('Error marked fixed', 200, $this->error_tracker_repository->markFixed($id));
    }

    public function destroy(string $id): JsonResponse
    {
        return ApiResponse::success('Report deleted successfully', 200, $this->error_tracker_repository->delete($id));
    }
}
