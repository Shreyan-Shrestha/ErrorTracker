<?php

namespace App\Helpers;

use App\Helpers\NepaliDate\src\NepaliDate;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Date;

class DateHelper
{
    public static function formatDateInterval(DateInterval $interval): string
    {
        $parts = [];
        if ($interval->y == 1) $parts[] = $interval->y . ' year';

        if ($interval->y > 1)  $parts[] = $interval->y . ' years';
        
        if ($interval->m == 1) $parts[] = $interval->m . ' month';

        if ($interval->m > 1)  $parts[] = $interval->m . ' months';
        
        if ($interval->d == 1) $parts[] =  $interval->d . ' day';

        if ($interval->d > 1)  $parts[] =  $interval->d . ' days';

        if ($interval->h == 1) $parts[] = $interval->h . ' hour';

        if ($interval->h > 1)  $parts[] = $interval->h . ' hours';

        if ($interval->i > 0)  $parts[] = $interval->i . ' minutes';
        
        if (empty($parts))     $parts[] = $interval->s . ' seconds';
        
        return implode(', ', array_splice($parts, 0, 2));
    }

    //Converting the timestamps from pgsql to readable formats in frontend.
    public static function formatTimestampToString(DateTime $format_time): string
    {
        return NepaliDate::fromAd($format_time)->toDateStringReadable(); // returns: F j, Y eg. Asadh 23, 2083.
    }

    //converting the start and end time strings to readable format in frontend.
    public static function formatDateString(String $format_time): string
    {
        $formatTime = NepaliDate::createFromFormat(NepaliDate::FORMAT_DATETIME_12_SHORT_SLASH_DMY, $format_time);
        return $formatTime->toDateStringReadable(); // returns: F j, Y eg: Asadh 22, 2083. 
    }
}
