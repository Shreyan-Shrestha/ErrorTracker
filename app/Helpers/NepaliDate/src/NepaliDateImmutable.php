<?php

declare(strict_types=1);

namespace App\Helpers\NepaliDate\src;

use App\Helpers\NepaliDate\src\NepaliDate;

class NepaliDateImmutable extends NepaliDate
{
    public function isImmutable(): bool
    {
        return true;
    }
}
