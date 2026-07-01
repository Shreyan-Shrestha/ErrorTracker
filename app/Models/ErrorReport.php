<?php

namespace App\Models;

use App\Enums\ErrorSeverity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorReport extends Model
{
  use SoftDeletes;
  protected $table = 'error_trackers';
  protected $fillable = [
    'reporter',
    'region',
    'branch',
    'project_id',
    'problem_id',
    'category_id',
    'impact',
    'root_cause',
    'trigger',
    'message', 
    'start_time',
    'end_time',
  ];

  public $casts = [
    'severity' => ErrorSeverity::class,
  ];

  public function project(): BelongsTo
  {
    return $this->belongsTo(Project::class);
  }

  public function problem(): BelongsTo
  {
    return $this->belongsTo(Problem::class);
  }
}
