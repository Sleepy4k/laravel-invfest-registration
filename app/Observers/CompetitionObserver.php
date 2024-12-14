<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Competition;
use Illuminate\Support\Str;

class CompetitionObserver
{
    /**
     * Handle the Competition "creating" event.
     */
    public function creating(Competition $competition): void
    {
        $competition->slug = Str::slug($competition->name);

        $competition->poster = $competition->poster
            ? File::saveSingleFile(UploadFileType::IMAGE, $competition->poster)
            : null;

        $competition->guidebook = $competition->guidebook
            ? File::saveSingleFile(UploadFileType::FILE, $competition->guidebook)
            : null;
    }

    /**
     * Handle the Competition "updating" event.
     */
    public function updating(Competition $competition): void
    {
        if ($competition->isDirty('name')) {
            $competition->slug = Str::slug($competition->name);
        }

        if ($competition->isDirty('poster')) {
            $oldPoster = $competition->getOriginal('poster', null);

            if ($oldPoster == null) {
                $competition->poster = $competition->poster
                    ? File::saveSingleFile(UploadFileType::IMAGE, $competition->poster)
                    : null;
            } else {
                $competition->poster = $competition->poster
                    ? File::updateSingleFile(UploadFileType::IMAGE, $competition->poster, $oldPoster)
                    : File::deleteFile(UploadFileType::IMAGE, $oldPoster);
            }
        }

        if ($competition->isDirty('guidebook')) {
            $oldGuidebook = $competition->getOriginal('guidebook', null);

            if ($oldGuidebook == null) {
                $competition->guidebook = $competition->guidebook
                    ? File::saveSingleFile(UploadFileType::FILE, $competition->guidebook)
                    : null;
            } else {
                $competition->guidebook = $competition->guidebook
                    ? File::updateSingleFile(UploadFileType::FILE, $competition->guidebook, $oldGuidebook)
                    : File::deleteFile(UploadFileType::FILE, $oldGuidebook);
            }
        }
    }

    /**
     * Handle the Competition "deleting" event.
     */
    public function deleting(Competition $competition): void
    {
        $competition->poster
            ? File::deleteFile(UploadFileType::IMAGE, $competition->poster)
            : null;

        $competition->guidebook
            ? File::deleteFile(UploadFileType::FILE, $competition->guidebook)
            : null;
    }
}
