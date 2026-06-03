<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    protected $table = 'applications';
    protected $fillable = ['name', 'gitlab_id'];
    use SoftDeletes;
}
