<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Storage\FileManager;

/**
 * @method static bool deleteFile(UploadFileType $type, UploadedFile $file)
 * @method static bool checkFile(UploadFileType $type, UploadedFile $file)
 * @method static string|null saveSingleFile(UploadFileType $type, UploadedFile $file)
 * @method static string|null updateSingleFile(UploadFileType $type, UploadedFile $file, string $oldFile)
 *
 * @see \App\Storage\FileManager
 *
 * @mixins \App\Storage\FileManager
 */
class File extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FileManager::class;
    }
}
