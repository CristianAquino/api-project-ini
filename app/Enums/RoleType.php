<?php

namespace App\Enums;

enum RoleType: string
{
    //
    case SuperAdmin = 'SA1234';
    case Admin = 'A1234';
    case User = 'U1234';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'SuperAdmin',
            self::Admin => 'Admin',
            self::User => 'User',
        };
    }
}
