<?php

namespace App\Repositories\Web\V1;

use App\Enums\ErrorSeverity;
use App\Enums\ErrorStatus;
use App\Models\ErrorReport;
use App\Models\Project;
use App\Models\UserRecord;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getCriticalErrors(): LengthAwarePaginator
    {
        return ErrorReport::with(['category', 'problem', 'project'])
        ->whereHas('category', function (Builder $query) {
            $query->whereIn('severity', [
                ErrorSeverity::Critical->value,
                ErrorSeverity::High->value
            ]);
        })
        ->where('status', '!=', ErrorStatus::Fixed->value)
        ->select(['id', 'status', 'category_id', 'problem_id', 'project_id', 'updated_at'])
        ->orderBy('updated_at', 'desc')
        ->paginate(5);
    }

    public function getErrorTrend(): array
    {
        $data = collect($this->getIntervals())->map(function($interval){
            return ErrorReport::whereBetween('created_at', [$interval[0], $interval[1]])->count();
        })->toArray();

        return [
            'labels' => $this->getLabels(),
            'values'  => [0, ...$data]
        ];
    }

    public function getErrorByRegion(): array
    {
        return [
            'labels' => ['KTM', 'DRN', 'PKR', 'BRJ', 'JNK'],
            'values' => [25,15,10,8,5]
        ];
    }
    
    public function getErrorsByProject(): array
    {
        $errorsByProject = ErrorReport::select('project_id')
        ->selectRaw('count(*) as aggregate')
        ->groupBy('project_id')
        ->orderByDesc('aggregate')
        ->with('project:id,project_name')
        ->get();

        return [
          'labels' =>$errorsByProject->pluck('project.project_name')->toArray(),
          'values' => $errorsByProject->pluck('aggregate')->toArray(),
        ];
    }

    public function getIntervals(): array
    {
        $now = now('Asia/Kathmandu');
        $start = $now->copy()->subDay();

        return [
            [$start->copy(), $start->copy()->addHours(4)],
            [$start->copy()->addHours(4), $start->copy()->addHours(8)],
            [$start->copy()->addHours(8), $start->copy()->addHours(12)],
            [$start->copy()->addHours(12), $start->copy()->addHours(16)],
            [$start->copy()->addHours(16), $start->copy()->addHours(20)],
            [$start->copy()->addHours(20), $now->copy()],
        ];
    }

    private function getLabels(): array
    {
        $now = now('Asia/Kathmandu');
        $start = $now->copy()->subDay();

        return [
            $start->format('H:i'),
            $start->copy()->addHours(4)->format('H:i'),
            $start->copy()->addHours(8)->format('H:i'),
            $start->copy()->addHours(12)->format('H:i'),
            $start->copy()->addHours(16)->format('H:i'),
            $start->copy()->addHours(20)->format('H:i'),
            'now',
        ];
    }

    public function getStats(): array
    {
        return [
            'projectCount'  => $this->getProjectCount(),
            'userCount'     => $this->getUsersCount(), 
            'errorCount'    => $this->getErrorsCount(),
            'criticalCount' => $this->getCriticalCount(),
        ];      
    }

    private function getProjectCount(): int
    {
        return Project::latest()->count();
    }

    private function getUsersCount(): int
    {
        return UserRecord::latest()->count();
    }

    private function getErrorsCount(): int
    {
        return ErrorReport::where('created_at', '>=', now()->subDay())->count();
    }

    private function getCriticalCount(): int
    {
        return ErrorReport::whereHas('category', function (Builder $query) {
            $query->where('severity', ErrorSeverity::Critical->value);
        })
        ->whereNot('status', ErrorStatus::Fixed->value)
        ->count();
    }
}