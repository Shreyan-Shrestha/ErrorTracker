<?php

namespace App\Enums;

enum ErrorSeverity : string
{
    case Critical = 'critical';
    case High     = 'high';
    case Medium   = 'medium';
    case Low      = 'low';

    public function label(){
        return match($this){
            ErrorSeverity::Critical => 'critical',
            ErrorSeverity::High     => 'high',
            ErrorSeverity::Medium   => 'medium',
            ErrorSeverity::Low      => 'low',
        };

    }
}
