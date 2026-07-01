<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\ErrorReportRequest;
use App\Models\ErrorReport;
use Illuminate\Pagination\LengthAwarePaginator;

interface ErrorReportRepositoryInterface
{
    public function getall(): LengthAwarePaginator;
    public function create(ErrorReportRequest $request): void;
    public function show(int $id): ErrorReport;
    public function update(ErrorReportRequest $request, ErrorReport $error): void;
    public function markFixed(int $id): void;
    public function delete(ErrorReport $error): void;
}
