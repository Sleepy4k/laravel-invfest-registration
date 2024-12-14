<?php

namespace App\Facades;

use App\Parse\FormatManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string formatFileSize(int|float $bytes, int $precision)
 * @method static string formatNumber(int|float $number, int $precision)
 * @method static string formatDate(string $date, string $format)
 *
 * @see \App\Storage\FormatManager
 *
 * @mixins \App\Storage\FormatManager
 */
class Format extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FormatManager::class;
    }
}
