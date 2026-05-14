<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use RohanAdhikari\NepaliDate\NepaliDate;

#[Fillable('region', 'branch', 'application_id','issue', 'impact', 'root_cause', 'estimated_down',
  'start_time', 'end_time', 'issue_triggered_by','error_message', 'severity')]

class ErrorTracker extends Model
{
    protected function casts(): array
    {
        return [
            'start_time' => NepaliDate::class,
            'end_time' => NepaliDate::class
        ];    
    }
}
