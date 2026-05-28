<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('name', 'gitlab_id')]
class Application extends Model
{
    protected $table = 'applications';
    use SoftDeletes;
}
