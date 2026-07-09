<?

namespace App\Repositories\Api;

use App\Enums\ErrorStatus;
use App\Models\ErrorReport;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use App\Helpers\DateHelper;
use App\Helpers\NepaliDate\src\NepaliDate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;


class ErrorReportRepository implements ErrorReportRepositoryInterface
{
    public function getall(): LengthAwarePaginator
    {
        return ErrorReport::orderBy('updated_at', 'desc')->paginate(10);
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
            $data['status'] = ErrorStatus::Fixed;
        } elseif (array_key_exists('end_time', $data) && is_null($data['end_time']) && !is_null($error->estimated_down)) {
            $data['estimated_down'] = null;
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
            'status' => ErrorStatus::Fixed
        ];

        $error->update($data);
    }

    public function delete(ErrorReport $error): void
    {
        $error->delete();
    }
}
