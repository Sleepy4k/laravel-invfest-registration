<?php

namespace App\Enums;

enum ActivityEventType: string
{
    case MODEL = 'model';
    case LOGIN = 'login';
    case LOGOUT = 'logout';

    /**
     * Get all the values from the enum
     *
     * @return array<string>
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
