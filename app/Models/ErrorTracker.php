<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorTracker extends Model
{
  use SoftDeletes;
  protected $table = 'error_trackers';
  protected $fillable = [
    'region',
    'branch',
    'application_id',
    'issue',
    'impact',
    'root_cause',
    'start_time',
    'issue_triggered_by',
    'error_message',
    'severity'
  ];
}
