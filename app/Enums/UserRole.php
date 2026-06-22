<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
    case Intern = 'intern';

    public function label(): string
    {
        return match($this){
            UserRole::Admin => 'admin',
            UserRole::User => 'user',
            UserRole::Intern => 'intern'
        };
    }
}
