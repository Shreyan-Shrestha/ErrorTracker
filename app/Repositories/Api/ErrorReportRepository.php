<?php

namespace App\Repositories\Api;

use Storage;
use Exception;
use RuntimeException;
use App\Enums\ErrorStatus;
use App\Helpers\DateHelper;
use App\Models\ErrorReport;
use App\Enums\ErrorSeverity;
use Illuminate\Http\UploadedFile;
use App\Helpers\NepaliDate\src\NepaliDate;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;

class ErrorReportRepository implements ErrorReportRepositoryInterface
{
    public function getall(int $paginate): LengthAwarePaginator
    {
        return ErrorReport::orderBy('updated_at', 'desc')->paginate($paginate);
    }

    public function getAllCount(): int
    {
        return ErrorReport::count();
    }

    public function show(int $id): ErrorReport
    {
        return ErrorReport::findorfail($id);
    }

    public function create(array $data): void
    {
        if (array_key_exists('end_time', $data) && !is_null($data['end_time'])) {
            $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $data['start_time']);
            $end_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $data['end_time']);
            $interval = $start_time->diffAsDateInterval($end_time);
            $data['estimated_down'] = DateHelper::formatDateInterval($interval);
            $data['status'] = ErrorStatus::Fixed->value;
        }

        if (isset($data['document']) && $data['document'] instanceof UploadedFile) {
            $file = $data['document'];

            try {
                $data['document'] = $file->getClientOriginalName();
                $data['document_path'] = Storage::disk('minio')->put('uploads', $file);
            } catch (\Exception $e) {
                throw new RuntimeException('Document upload failed'. $e->getMessage());
            }
        }

        ErrorReport::create($data);
    }

    public function update(array $data, ErrorReport $error): void
    {
        if (!empty($data['end_time'])) {
            $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $data['start_time']);
            $end_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $data['end_time']);
            $interval = $start_time->diffAsDateInterval($end_time);
            $estimated_down = DateHelper::formatDateInterval($interval);
            $data['estimated_down'] = $estimated_down;
            $data['status'] = ErrorStatus::Fixed->value;
        } elseif (array_key_exists('end_time', $data) && is_null($data['end_time']) && !is_null($error->estimated_down)) {
            $data['estimated_down'] = null;
        }

        if (isset($data['document']) && $data['document'] instanceof UploadedFile) {
            if ($error->document_path) {
                Storage::disk('minio')->delete($error->document_path);
            }

            $file = $data['document'];

            try {
                $data['document'] = $file->getClientOriginalName();
                $data['document_path'] = Storage::disk('minio')->putFile('uploads', $file);
            } catch (Exception $e) {
                throw new RuntimeException('Document upload failed'. $e->getMessage());
            }
        } else {
            unset($data['document']);
            unset($data['document_path']);
        }

        $error->update($data);
    }

    public function analysis(array $data, ErrorReport $error): void
    {
        $error->update($data);
    }

    public function markFixed(ErrorReport $error): void
    {
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $error->start_time);

        $end_time = NepaliDate::now();

        $interval = $start_time->diffAsDateInterval($end_time);
        $estimated_down = DateHelper::formatDateInterval($interval);

        $data = [
            'end_time' => $end_time->toDateString(),
            'estimated_down' => $estimated_down,
            'status' => ErrorStatus::Fixed->value
        ];

        $error->update($data);
    }

    public function delete(ErrorReport $error): void
    {
        if ($error->document_path) {
            Storage::disk('minio')->delete($error->document_path);
        }
        $error->delete();
    }

    public function getStats(): array
    {
        return [
            'reported'   => $this->getReported(),
            'resolved'   => $this->getResolved(),
            'unresolved' => $this->getUnresolved(),
            'critical'   => $this->getCritical()
        ];
    }

    private function getReported(): array
    {
        return [
            'value' => $this->getAllCount(),
            'change' => $this->getReportedChange(),
        ];
    }

    private function getReportedChange(): int
    {
        $total = $this->getAllCount();
        $count = ErrorReport::where('created_at', '>=', now()->subDay())->count();
        return $total > 0 ? round(($count / $total) * 100, 0) : 0;
    }

    private function getResolved(): array
    {
        return [
            'value' => ErrorReport::where('status', ErrorStatus::Fixed->value)->count()
        ];
    }

    private function getUnresolved(): array
    {
        return [
            'value' => ErrorReport::whereNot('status', ErrorStatus::Fixed->value)->count()
        ];
    }

    private function getCritical(): array
    {
        return
            [
                'value' => ErrorReport::whereHas('category', function ($query) {
                    $query->where('severity', ErrorSeverity::Critical->value);
                })->count()
            ];
    }
}
