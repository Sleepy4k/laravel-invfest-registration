<?php

namespace App\Facades;

use App\Storage\LogReaderManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getFileList(LogReaderType $type, string $channel)
 * @method static array getFileContent(string $date)
 * @method static string getAllFileContent(LogReaderType $type, string $channel, ?string $date)
 *
 * @see \App\Storage\LogReaderManager
 *
 * @mixins \App\Storage\LogReaderManager
 */
class LogReader extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return LogReaderManager::class;
    }
}
