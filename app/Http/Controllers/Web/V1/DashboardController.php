<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    protected DashboardRepositoryInterface $dashboard_repository;

    public function __construct( DashboardRepositoryInterface $dashboard_repository)
    {
        $this->dashboard_repository = $dashboard_repository;
    }

    public function index(): View
    {
        $cardData = $this->dashboard_repository->getStats();
        $errorsdata = $this->dashboard_repository->getCriticalErrors();
        return view('dashboard.index', compact('errorsdata', 'cardData'));
    }

    public function getErrorTrend(): JsonResponse
    {
        return Response::success($this->dashboard_repository->getErrorTrend());    
    }

    public function getByRegion(): JsonResponse {
        return Response::success($this->dashboard_repository->getErrorByRegion());
    }

    public function getByProject(): JsonResponse {
        return Response::success($this->dashboard_repository->getErrorsByProject());
    }
}
