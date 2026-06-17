<?

namespace App\Repositories\Api;

use App\Models\ErrorTracker;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Helpers\DateHelper;

use App\Helpers\NepaliDate\src\NepaliDate;
use App\Http\Requests\ErrorTrackerRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class ErrorTrackerRepository implements ErrorTrackerRepositoryInterface
{
    public function getall(): LengthAwarePaginator
    {
        return ErrorTracker::latest()->paginate();
    }

    public function show(int $id): ErrorTracker
    {
        return ErrorTracker::findorfail($id);
    }

    public function create(ErrorTrackerRequest $request): void
    {
        $validated = $request->validated();
        ErrorTracker::create($validated);
    }

    public function update(ErrorTrackerRequest $request, ErrorTracker $error): void
    {
        $validated = $request->validated();
        $error->update($validated);
    }

    public function markFixed(int $id): void
    {
        $err = ErrorTracker::findorfail($id);
        $end_time = NepaliDate::now();
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT, $err->start_time);

        $interval = $end_time->diffAsDateInterval($start_time);
        $estimated_down = DateHelper::formatDateInterval($interval);

        $err->update([
            'end_time' => $end_time->toDateTimeString(),
            'estimated_down' => $estimated_down,
        ]);
    }

    public function delete(ErrorTracker $error): void
    {
        $error->delete();
    }
}
