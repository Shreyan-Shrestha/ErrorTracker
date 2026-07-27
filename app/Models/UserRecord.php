<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRecord extends Model
{
    use SoftDeletes;
    protected $table="user_records";
    protected $fillable = ['first_name', 'last_name', 'email', 'role', 'region', 'branch'];

    public $casts = [
        'role' => UserRole::class,
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_record_id');
    }

    public function assingedProjects(): HasMany
    {
        return $this->hasMany(ErrorReport::class, 'assign_id');
    }

    public function errors(): HasMany
    {
        return $this->hasMany(ErrorReport::class, 'user_record_id');
    }
}
