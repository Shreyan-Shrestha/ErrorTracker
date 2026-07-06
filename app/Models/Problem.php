<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Problem extends Model
{
    protected $table = 'problems';
    protected $fillable = ['name'];

    public function errors(): HasMany
    {
        return $this->hasMany(ErrorReport::class);
    }
}
