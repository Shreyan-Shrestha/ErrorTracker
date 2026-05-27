<?

namespace App\Repositories\Api;

use App\Models\ErrorTracker;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use App\Helpers\DateHelper;
use RohanAdhikari\NepaliDate\NepaliDate;
use RohanAdhikari\NepaliDate\NepaliDateInterface;

class ErrorTrackerRepository implements ErrorTrackerRepositoryInterface
{
    public function getall()
    {
        $err =  ErrorTracker::all();
        if ($err) {
            return $err;
        }
    }

    public function show(int $id)
    {
        return ErrorTracker::findorfail($id);
    }

    public function create(array $data)
    {
        ErrorTracker::create($data);
    }

    public function update(int $id, array $data)
    {
        $err = ErrorTracker::where('id', $id);
        $err->update($data);
    }

    public function markFixed(int $id)
    {
        $err = ErrorTracker::findorfail($id);

        $end_time = NepaliDate::now();
        $start_time = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT,$err->start_time);
    
        $interval = $end_time->diffAsDateInterval($start_time);
        $estimated_down = DateHelper::formatDateInterval($interval);
        $err->update([
            'end_time' => $end_time->format(NepaliDateInterface::FORMAT_DATETIME_12_SHORT),
            'estimated_down' => $estimated_down,
        ]);
    }

    public function delete(int $id)
    {
        $err = ErrorTracker::findorfail($id);
        $err->delete();
    }
}
