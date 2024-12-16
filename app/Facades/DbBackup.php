<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Storage\DatabaseBackupManager;

/**
 * @method static array getFileList()
 * @method static bool createBackup()
 * @method static bool deleteFile(string $date)
 * @method static \Symfony\Component\HttpFoundation\BinaryFileResponse downloadFile(string $date)
 *
 * @see \App\Storage\DatabaseBackupManager
 *
 * @mixins \App\Storage\DatabaseBackupManager
 */
class DbBackup extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return DatabaseBackupManager::class;
    }
}
