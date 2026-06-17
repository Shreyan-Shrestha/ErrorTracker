<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ErrorTrackerRequest;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ErrorTrackerController extends Controller
{
    protected ErrorTrackerRepositoryInterface $error_tracker_repository;

    public function __construct(ErrorTrackerRepositoryInterface $error_tracker_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
    }

    public function index(): JsonResponse
    {
        return Response::success($this->error_tracker_repository->getall());
    }

    public function store(ErrorTrackerRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->error_tracker_repository->create($validated));
    }

    public function show(string $id): JsonResponse
    {
        return Response::success($this->error_tracker_repository->show($id));
    }

    public function update(ErrorTrackerRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->error_tracker_repository->update($id, $validated));
    }

    public function markFixed(int $id): JsonResponse
    {
        return Response::success($this->error_tracker_repository->markFixed($id));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->error_tracker_repository->delete($id);
        return Response::success();
    }
}
