<?php

namespace App\Enums;

enum ProjectStatus : string
{
    case Completed = 'completed';
    case Ongoing = 'ongoing';
    case Abandoned = 'abandoned';

    public function label() : string
    {
        return match($this){
            ProjectStatus::Completed  => 'completed',
            ProjectStatus::Ongoing    => 'ongoing',
            ProjectStatus::Abandoned  => 'abandooned',
        };
    }
}
