<?php

namespace App\Enums;

enum ErrorStatus : string
{
    case Reported       = 'Reported';
    case Investigating  = 'Investigating';
    case Fix_Proposed   = 'Fix Proposed';
    case Fixed          = 'Fixed';

    public function label(): string
    {
        return match($this){
            ErrorStatus::Reported      => 'Reported',
            ErrorStatus::Investigating => 'Investigating',
            ErrorStatus::Fix_Proposed  => 'Fix Proposed',
            ErrorStatus::Fixed         => 'Fixed'
        };
    }

    public function color(): string
    {
        return match($this){
            ErrorStatus::Reported      => 'py-2 rounded-box bg-neutral text-neutral-content',
            ErrorStatus::Investigating => 'py-2 rounded-box bg-orange-200 text-warning-content',
            ErrorStatus::Fix_Proposed  => 'py-2 rounded-box bg-info text-info-content',
            ErrorStatus::Fixed         => 'py-2 rounded-box bg-green-200 text-success-content'
        };
    }
    public function status(): string
    {
        return match($this)
        {
        ErrorStatus::Reported      => 'status-neutral',
        ErrorStatus::Investigating => 'status-warning',
        ErrorStatus::Fix_Proposed  => 'status-info',
        ErrorStatus::Fixed         => 'status-success'
        };
    }
}
