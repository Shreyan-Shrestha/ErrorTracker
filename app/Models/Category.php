<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'severity'];

    protected $casts = [
        'severity' => \App\Enums\ErrorSeverity::class,
    ];

    public function errors(): HasMany
    {
        return $this->hasMany(ErrorReport::class);
    }
}
