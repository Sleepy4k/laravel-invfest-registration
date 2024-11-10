<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case APPROVE = 'approve';
    case REJECT = 'reject';

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
