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
            ErrorSeverity::Critical => 'CRITICAL',
            ErrorSeverity::High     => 'HIGH',
            ErrorSeverity::Medium   => 'MEDIUM',
            ErrorSeverity::Low      => 'LOW',
        };
    }

    public function color(): string
    {
        return match($this){
            ErrorSeverity::Critical => 'py-2 rounded-box bg-red-200 text-error-content',
            ErrorSeverity::High => 'py-2 rounded-box bg-orange-200 text-warning-content',
            ErrorSeverity::Medium => 'py-2 rounded-box bg-yellow-200 text-yellow-800',
            ErrorSeverity::Low => 'py-2 roundedbox bg-blue-200 text-info-content'
        };
    }

    public function status(): string
    {
        return match($this){
            ErrorSeverity::Critical => 'bg-red-600',
            ErrorSeverity::High => 'bg-orange-600',
            ErrorSeverity::Medium => 'bg-yellow-600',
            ErrorSeverity::Low => 'bg-cyan-600'
        };    
    
    }

    public function impact(): int
    {
        return match($this){
            ErrorSeverity::Critical => 8,
            ErrorSeverity::High => 5,
            ErrorSeverity::Medium => 3,
            ErrorSeverity::Low => 1
        };
    }
}
