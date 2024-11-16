<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\Competition;
use App\Traits\UploadFile;
use Illuminate\Support\Str;

class CompetitionObserver
{
    use UploadFile;

    /**
     * Handle the Competition "creating" event.
     */
    public function creating(Competition $competition): void
    {
        if ($competition->getKey() === null) {
            $competition->setAttribute($competition->getKeyName(), Str::uuid());
        }

        $competition->slug = Str::slug($competition->name);

        $competition->poster = $competition->poster
            ? $this->saveSingleFile(UploadFileType::IMAGE, $competition->poster)
            : null;

        $competition->guidebook = $competition->guidebook
            ? $this->saveSingleFile(UploadFileType::FILE, $competition->guidebook)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $competition->poster)
                    : null;
            } else {
                $competition->poster = $competition->poster
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $competition->poster, $oldPoster)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldPoster);
            }
        }

        if ($competition->isDirty('guidebook')) {
            $oldGuidebook = $competition->getOriginal('guidebook', null);

            if ($oldGuidebook == null) {
                $competition->guidebook = $competition->guidebook
                    ? $this->saveSingleFile(UploadFileType::FILE, $competition->guidebook)
                    : null;
            } else {
                $competition->guidebook = $competition->guidebook
                    ? $this->updateSingleFile(UploadFileType::FILE, $competition->guidebook, $oldGuidebook)
                    : $this->deleteFile(UploadFileType::FILE, $oldGuidebook);
            }
        }
    }

    /**
     * Handle the Competition "deleting" event.
     */
    public function deleting(Competition $competition): void
    {
        $competition->poster
            ? $this->deleteFile(UploadFileType::IMAGE, $competition->poster)
            : null;

        $competition->guidebook
            ? $this->deleteFile(UploadFileType::FILE, $competition->guidebook)
            : null;
    }
}
