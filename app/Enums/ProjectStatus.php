<?php

namespace App\Enums;

enum ProjectStatus : string
{
    case Completed = 'completed';
    case Ongoing = 'ongoing';
    case Abandoned = 'abandoned';
    case In_Review = 'in review';

    public function label() : string
    {
        return match($this){
            ProjectStatus::Completed  => 'completed',
            ProjectStatus::Ongoing    => 'ongoing',
            ProjectStatus::Abandoned  => 'abandoned',
            ProjectStatus::In_Review => 'in review'
        };
    }

    public function color(): string
    {
        return match($this){
            ProjectStatus::Completed => 'py-2 rounded-box bg-green-200 text-success-content',
            ProjectStatus::Ongoing => 'py-2 rounded-box bg-orange-200 text-warning-content',
            ProjectStatus::Abandoned => 'py-2 rounded-box bg-red-200 text-error-content',
            ProjectStatus::In_Review => 'py-2 rounded-box bg-blue-200 text-info-content',
        };
    }

    public function  status() : string {
        return match($this){
            ProjectStatus::Completed => 'bg-green-700',
            ProjectStatus::Ongoing => 'bg-orange-700',
            ProjectStatus::Abandoned => 'bg-red-700',
            ProjectStatus::In_Review => 'bg-blue-700',
        };
    }
}
