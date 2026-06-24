<?php

namespace App\Repositories\Interfaces;

use App\Models\UserRecord;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRecordRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function show(UserRecord $user): UserRecord;
    public function create(array $data): void;
    public function update(array $data, UserRecord $user): void;
    public function destroy(UserRecord $user): void;
}
