<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProblemRequest;
use App\Repositories\Interfaces\ProblemRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

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
        return Response::success('Problem records retrieved successfully', 200, $this->problemRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProblemRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->problemRepository->create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return Response::success($this->problemRepository->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->problemRepository->update($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): HttpResponse
    {
        $this->problemRepository->destroy($id);
        return Response::success('Problem record deleted successfully');
    }
}
