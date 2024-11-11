<?php

namespace App\Enums;

enum StorageBaseType: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';

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