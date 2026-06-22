<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRecords extends Model
{
    use SoftDeletes;
    protected $table="user_records";
    protected $fillable = ['name', 'email', 'role', 'region', 'branch'];

    public $casts = [
        'role' => UserRole::class,
    ];
}
