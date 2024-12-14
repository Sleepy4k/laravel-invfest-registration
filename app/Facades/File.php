<?php

namespace App\Facades;

use App\Storage\FileManager;
use Illuminate\Support\Facades\Facade;

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
