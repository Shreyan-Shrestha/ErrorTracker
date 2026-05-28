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
        try {
            $validated = $request->validated();
            $this->error_tracker_repository->create($validated);
            return response()->json(['Error Reported Successfully'], 201);
        } catch (Throwable $e) {
            return response()->json([
                'error' => 'Save failed. Try again later'
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            return response()->json($this->error_tracker_repository->show($id));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Id not found',
            ], 404);
        }
    }

    public function update(ErrorTrackerRequest $request, string $id)
    {
        try {
            $validated = $request->validated();
            response()->json($this->error_tracker_repository->update($id, $validated));
            return response()->json('Error Report updated successfully');
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Error with provided id not found',
            ], 404);
        }
    }

    public function markFixed(int $id)
    {
        try {
            $this->error_tracker_repository->markFixed($id);
            return response()->json(['message' => 'Error marked fixed']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Report with provided id not found'
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->error_tracker_repository->delete($id);
            return response()->json(['Report deleted successfully']);
        } catch (Throwable $e) {
            return response()->json([
                'error' => 'Delete failed'
            ], 500);
        }
    }
}
