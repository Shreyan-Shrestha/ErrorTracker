<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
    protected $fillable = ['gitlab_id', 'project_name', 'status'];

    public $casts = [
        'status' => ProjectStatus::class,
    ];
}
