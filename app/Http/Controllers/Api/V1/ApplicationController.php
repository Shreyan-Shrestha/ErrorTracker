<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApplicationRequest;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApplicationController extends Controller
{
    protected ApplicationRepositoryInterface $applicationRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function index(): JsonResponse
    {
        return Response::success($this->applicationRepository->getAll());
    }

    public function store(ApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();

        return Response::success($this->applicationRepository->create($data));
    }

    public function show(int $id): JsonResponse
    {
        return Response::success($this->applicationRepository->getById($id));
    }

    public function update(ApplicationRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        return Response::success($this->applicationRepository->update($id, $data));
    }

    public function destroy(int $id): JsonResponse
    {
        return Response::success($this->applicationRepository->delete($id));
    }
}
