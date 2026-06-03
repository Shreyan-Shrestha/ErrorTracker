<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApplicationRequest;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    protected ApplicationRepositoryInterface $applicationRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function index(): JsonResponse
    {
        return ApiResponse::success('Application retrieved successfully', 200, $this->applicationRepository->getAll());
    }

    public function store(ApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();

        return ApiResponse::success('Application created successfully', 201,  $this->applicationRepository->create($data));
    }

    public function show(int $id): JsonResponse
    {
        return ApiResponse::success('Application fetched successfully', 200, $this->applicationRepository->getById($id));
    }

    public function update(ApplicationRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        return ApiResponse::success('Application updated successfully', 200, $this->applicationRepository->update($id, $data));
    }

    public function destroy(int $id): JsonResponse
    {
        return ApiResponse::success('Application deleted successfully', 200, $this->applicationRepository->delete($id));
    }
}
