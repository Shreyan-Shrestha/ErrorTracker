<?
namespace App\Repositories\Api;

use App\Models\ErrorTracker;
use App\Repositories\Interfaces\ErrorTrackerRepositoryInterface;
use Override;

class ErrorTrackerRepository implements ErrorTrackerRepositoryInterface
{
    public function getall()
    {
        $err =  ErrorTracker::all();
        return response()->json($err);
    }

    public function show(int $id){
        return ErrorTracker::findorfail($id);
    }

    public function create(array $data){
        ErrorTracker::create($data);
        return response()->json('Error reported successfully', 201);
    }

    public function update(int $id, array $data){
        $err = ErrorTracker::where('id', $id);
        $err->update($data);
        return 'Updated Successfully';
    }

    public function delete(int $id){
        $err = ErrorTracker::findorfail($id);
        $err->delete();
        return 'Deleted successfully';
    }
}
