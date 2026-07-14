<?php

namespace App\Models;

use App\Enums\ErrorSeverity;
use App\Enums\ErrorStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorReport extends Model
{
  use SoftDeletes;
  protected $table = 'error_reports';

  protected $fillable = [
    'user_record_id',
    'region',
    'branch',
    'project_id',
    'problem_id',
    'category_id',
    'impact',
    'root_cause',
    'trigger',
    'message',
    'status',
    'start_time',
    'end_time',
    'estimated_down',
  ];

  public $casts = [
    'status' => ErrorStatus::class,
  ];

  public function project(): BelongsTo
  {
    return $this->belongsTo(Project::class);
  }

  public function problem(): BelongsTo
  {
    return $this->belongsTo(Problem::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(UserRecord::class);
  }

  public function scopeOrderBySeverity(Builder $query): Builder
  {
    return $query->orderByRaw(
    "CASE (SELECT severity FROM categories WHERE id = error_reports.category_id)
    WHEN 'critical' THEN 1
    WHEN 'high' THEN 2
    WHEN 'medium' THEN 3
    WHEN 'low' THEN 4
    ELSE 5 END"
    );
  }
}
