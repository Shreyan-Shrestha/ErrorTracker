<?php

namespace App\Helpers\NepaliDate\src\Laravel\Casts;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\NepaliDate\src\NepaliDate;

class AsNepaliDate implements \Illuminate\Contracts\Database\Eloquent\CastsAttributes
{
    protected string $format;

    public function __construct($format = 'Y-m-d')
    {
        $this->format = $format;
    }

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (blank($value)) {
            return null;
        }
        return NepaliDate::createFromFormat($this->format, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (blank($value)) {
            return null;
        }
        return NepaliDate::parse($value)->locale(NepaliDate::ENGLISH)->format($this->format);
    }
}
