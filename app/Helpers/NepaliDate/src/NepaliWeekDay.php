<?php

declare(strict_types=1);

namespace App\Helpers\NepaliDate\src;

enum NepaliWeekDay: int
{
    case Sunday = 1;
    case Monday = 2;
    case Tuesday = 3;
    case Wednesday = 4;
    case Thursday = 5;
    case Friday = 6;
    case Saturday = 7;

    public static function int(self|int|null $value): ?int
    {
        return $value instanceof self ? $value->value : $value;
    }
}
