<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('gitlab_id', 'project_name', 'status')]
class Project extends Model
{
    use SoftDeletes;
    protected $table = 'projects';

    public $casts = [
        'status' => ProjectStatus::class,
    ];
}
