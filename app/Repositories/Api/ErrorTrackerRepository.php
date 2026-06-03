<?

namespace App\Repositories\Api;

use App\Models\ErrorTracker;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Helpers\DateHelper;
use RohanAdhikari\NepaliDate\NepaliDate;
use RohanAdhikari\NepaliDate\NepaliDateInterface;

class ErrorTrackerRepository implements ErrorTrackerRepositoryInterface
{
    public function getall(): array
    {
        return ErrorTracker::all()->toArray();
    }

    public function show(int $id): array
    {
        return ErrorTracker::findorfail($id)->toArray();
    }

    public function create(array $data): array
    {
        return ErrorTracker::create($data)->toArray();
    }

    public function update(int $id, array $data): array
    {
        $err = ErrorTracker::findorfail($id);
        return $err->update($data)->toArray();
    }

    public function markFixed(int $id): array
    {
        $err = ErrorTracker::findorfail($id);

        $end_time = NepaliDate::now();
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT, $err->start_time);

        $interval = $end_time->diffAsDateInterval($start_time);
        $estimated_down = DateHelper::formatDateInterval($interval);
        $err->update([
            'end_time' => $end_time->format(NepaliDateInterface::FORMAT_DATETIME_12_SHORT),
            'estimated_down' => $estimated_down,
        ]);
        return $err->toArray();
    }

    public function delete(int $id): array
    {
        $err = ErrorTracker::findorfail($id);
        return $err->delete()->toArray();
    }
}
