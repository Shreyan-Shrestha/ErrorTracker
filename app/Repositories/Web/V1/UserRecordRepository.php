<?php

namespace App\Repositories\Web\V1;

use App\Models\UserRecord;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRecordRepository implements UserRecordRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
       return UserRecord::latest()->paginate(10); 
    }

    public function show(UserRecord $user): UserRecord
    {
        return $user;
    }

    public function create(array $data): void
    {
        UserRecord::create($data);
    }

    public function update(array $data, UserRecord $user): void
    {
        $user->update($data);
    }

    public function destroy(UserRecord $user): void
    {
        $user->delete();
    }
}
