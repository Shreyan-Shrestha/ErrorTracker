<?php

namespace App\Helpers;

use DateInterval;

class DateHelper
{
    public static function formatDateInterval(DateInterval $interval): string
    {
        $parts = [];
        if ($interval->m == 1) $parts[] = $interval->m . ' month';

        if ($interval->m > 1)  $parts[] = $interval->m . ' months';
        
        if ($interval->d == 1) $parts[] =  $interval->d . ' day';

        if ($interval->d > 1)  $parts[] =  $interval->d . ' days';

        if ($interval->h == 1) $parts[] = $interval->h . ' hour';

        if ($interval->h > 1)  $parts[] = $interval->h . ' hours';

        if ($interval->i > 0)  $parts[] = $interval->i . ' minutes';
        
        if (empty($parts))     $parts[] = $interval->s . ' seconds';
        
        $parts = array_slice($parts, 0, 2);
        return implode(', ', $parts);
    }
}
