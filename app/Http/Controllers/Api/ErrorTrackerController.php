<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ErrorTrackerRequest;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class ErrorTrackerController extends Controller
{
    protected ErrorTrackerRepositoryInterface $error_tracker_repository;

    public function __construct(ErrorTrackerRepositoryInterface $error_tracker_repository)
    {
        $this->error_tracker_repository = $error_tracker_repository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->error_tracker_repository->getall());
    }

    public function store(ErrorTrackerRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $this->error_tracker_repository->create($validated);
        return response()->json(['Error Reported Successfully'], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json($this->error_tracker_repository->show($id));
    }

    public function update(ErrorTrackerRequest $request, string $id)
    {
        $validated = $request->validated();
        response()->json($this->error_tracker_repository->update($id, $validated));
        return response()->json('Error Report updated successfully');
    }

    public function markFixed(int $id)
    {
        $this->error_tracker_repository->markFixed($id);
        return response()->json(['message' => 'Error marked fixed']);
    }

    public function destroy(string $id)
    {

        $this->error_tracker_repository->delete($id);
        return response()->json(['Report deleted successfully']);
    }
}
