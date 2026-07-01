<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ErrorReportRequest;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ErrorReportController extends Controller
{
    protected ErrorReportRepositoryInterface $error_report_repository;

    public function __construct(ErrorReportRepositoryInterface $error_report_repository)
    {
        $this->error_report_repository = $error_report_repository;
    }

    public function index(): JsonResponse
    {
        return Response::success($this->error_report_repository->getall());
    }

    public function store(ErrorReportRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->error_report_repository->create($validated));
    }

    public function show(string $id): JsonResponse
    {
        return Response::success($this->error_report_repository->show($id));
    }

    public function update(ErrorReportRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        return Response::success($this->error_report_repository->update($id, $validated));
    }

    public function markFixed(int $id): JsonResponse
    {
        return Response::success($this->error_report_repository->markFixed($id));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->error_report_repository->delete($id);
        return Response::success();
    }
}
