<?

namespace App\Repositories\Api;

use App\Models\ErrorReport;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use App\Helpers\DateHelper;
use App\Helpers\NepaliDate\src\NepaliDate;
use App\Http\Requests\Api\ErrorReportRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

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
        if(array_key_exists('end_time', $data) && !is_null($data['end_time']))
        {
            $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY,$data['start_time']);
            $end_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY,$data['end_time']);
            $interval = $start_time->diffAsDateInterval($end_time);
            $estimated_down = DateHelper::formatDateInterval($interval);
            $data['estimated_down'] = $estimated_down;
        }

        ErrorReport::create($data);
    }

    public function update(array $data, ErrorReport $error): void
    {
        if(array_key_exists('end_time', $data) && !is_null($data['end_time']))
        {
            $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY,$data['start_time']);
            $end_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY,$data['end_time']);
            $interval = $start_time->diffAsDateInterval($end_time);
            $estimated_down = DateHelper::formatDateInterval($interval);
            $data['estimated_down'] = $estimated_down;
        }

        if(array_key_exists('end_time', $data) && is_null($data['end_time']) && !is_null($error->estimated_down))
        {
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
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY,$error->start_time);

        $end_time = NepaliDate::now();

        $interval = $start_time->diffAsDateInterval($end_time);
        $estimated_down = DateHelper::formatDateInterval($interval);

        $data = [  
        'end_time' => $end_time->toDateString(),
        'estimated_down' => $estimated_down,
        ];

        $error->update($data);
    }

    public function delete(ErrorReport $error): void
    {
        $error->delete();
    }
}
