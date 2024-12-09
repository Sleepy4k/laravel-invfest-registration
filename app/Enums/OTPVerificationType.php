<?php

namespace App\Enums;

enum OTPVerificationType: string
{
    case REGISTER = 'register';
    case RESEND = 'resend';

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
