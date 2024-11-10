<?php

namespace App\Enums;

enum UploadFileType: string
{
    case FILE = 'files';
    case IMAGE = 'images';
    case SETTING = 'settings';

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
