<?php

namespace App\Enums;

enum ProjectStatus : string
{
    case COMPLETED = 'completed';
    case ONGOING = 'ongoing';
    case ABANDONED = 'abandoned';

    public function label() : string
    {
        return match($this){
            ProjectStatus::COMPLETED  => 'completed',
            ProjectStatus::ONGOING    => 'ongoing',
            ProjectStatus::ABANDONED  => 'abandooned',
        };
    }
}
