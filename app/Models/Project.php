<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
    protected $fillable = ['gitlab_id', 'user_record_id', 'project_name', 'status', 'description'];

    public $casts = [
        'status' => ProjectStatus::class,
    ];

    public function subProjects() : BelongsToMany {
        return $this->belongsToMany(Project::class, 'project_sub_project', 'parent_id', 'sub_project_id')->withTimestamps();
    }

    public function parentProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_sub_project', 'sub_project_id', 'parent_id')->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserRecord::class, 'user_record_id');
    }

    public function errors(): HasMany
    {
        return $this->hasMany(ErrorReport::class);
    }
}
