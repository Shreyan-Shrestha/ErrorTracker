<?php

namespace App\Enums;

enum ErrorStatus : string
{
    case Unassigned     = 'Unassigned';
    case Investigating  = 'Investigating';
    case Fix_Proposed   = 'Fix Proposed';
    case Fixed          = 'Fixed';

    public function label(): string
    {
        return match($this){
            ErrorStatus::Unassigned    => 'Unassigned',
            ErrorStatus::Investigating => 'Investigating',
            ErrorStatus::Fix_Proposed  => 'Fix Proposed',
            ErrorStatus::Fixed         => 'Fixed'
        };
    }

    public function color(): string
    {
        return match($this){
            ErrorStatus::Unassigned    => 'py-2 rounded-box bg-neutral text-neutral-content',
            ErrorStatus::Investigating => 'py-2 rounded-box bg-orange-200 text-warning-content',
            ErrorStatus::Fix_Proposed  => 'py-2 rounded-box bg-info text-info-content',
            ErrorStatus::Fixed         => 'py-2 rounded-box bg-green-200 text-success-content'
        };
    }
}
