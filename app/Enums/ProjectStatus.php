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
            ProjectStatus::Abandoned  => 'abandoned',
        };
    }

    public function color(): string
    {
        return match($this){
            ProjectStatus::Completed => 'py-2 rounded-box bg-green-200 text-success-content',
            ProjectStatus::Ongoing => 'py-2 rounded-box bg-orange-200 text-warning-content',
            ProjectStatus::Abandoned => 'py-2 rounded-box bg-red-200 text-error-content',
        };
    }

    public function  status() : string {
        return match($this){
            ProjectStatus::Completed => 'bg-green-800',
            ProjectStatus::Ongoing => 'bg-orange-800',
            ProjectStatus::Abandoned => 'bg-red-800',
        };
    }
}
