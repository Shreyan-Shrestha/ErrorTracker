<?

namespace App\Repositories\Api;

use App\Models\ErrorTracker;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Helpers\DateHelper;
use Illuminate\Http\Response;

use App\Helpers\NepaliDate\src\NepaliDate;
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

    public function create(array $data): ErrorTracker
    {
        return ErrorTracker::create($data);
    }

    public function update(int $id, array $data): ErrorTracker
    {
        $err = ErrorTracker::findorfail($id);
        return $err->update($data);
    }

    public function markFixed(int $id): ErrorTracker
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
        return $err->fresh();
    }

    public function delete(int $id): Response
    {
        $err = ErrorTracker::findorfail($id);
        $err->delete();
        return response()->noContent();
    }
}
