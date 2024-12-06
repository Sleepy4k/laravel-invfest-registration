<?php

namespace App\Enums;

enum CustomValidationType: string
{
    case IMAGE_MIMES = 'image_mimes';
    case IMAGE_MAX_SIZE = 'image_max_size';
    case FILE_MIMES = 'document_mimes';
    case FILE_MAX_SIZE = 'document_max_size';

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
