<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\ErrorReportRequest;
use App\Models\ErrorReport;
use Illuminate\Pagination\LengthAwarePaginator;

interface ErrorReportRepositoryInterface
{
    public function getall(): LengthAwarePaginator;
    public function create(array $data): void;
    public function show(int $id): ErrorReport;
    public function update(array $data, ErrorReport $error): void;
    public function analysis(array $data, ErrorReport $error): void;
    public function markFixed(ErrorReport $error): void;
    public function delete(ErrorReport $error): void;
}
