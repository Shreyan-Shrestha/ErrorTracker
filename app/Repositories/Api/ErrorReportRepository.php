<?

namespace App\Repositories\Api;

use App\Models\ErrorReport;
use App\Repositories\Interfaces\ErrorReportRepositoryInterface;
use App\Helpers\DateHelper;
use App\Helpers\NepaliDate\src\NepaliDate;
use App\Http\Requests\Api\ErrorReportRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class ErrorReportRepository implements ErrorReportRepositoryInterface
{
    public function getall(): LengthAwarePaginator
    {
        return ErrorReport::latest()->paginate();
    }

    public function show(int $id): ErrorReport
    {
        return ErrorReport::findorfail($id);
    }

    public function create(ErrorReportRequest $request): void
    {
        $validated = $request->validated();
        ErrorReport::create($validated);
    }

    public function update(ErrorReportRequest $request, ErrorReport $error): void
    {
        $validated = $request->validated();
        $error->update($validated);
    }

    public function markFixed(int $id): void
    {
        $err = ErrorReport::findorfail($id);
        $end_time = NepaliDate::now();
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT, $err->start_time);

        $interval = $end_time->diffAsDateInterval($start_time);
        $estimated_down = DateHelper::formatDateInterval($interval);

        $err->update([
            'end_time' => $end_time->toDateTimeString(),
            'estimated_down' => $estimated_down,
        ]);
    }

    public function delete(ErrorReport $error): void
    {
        $error->delete();
    }
}
