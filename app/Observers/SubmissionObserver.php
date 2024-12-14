<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Submission;

class SubmissionObserver
{
    /**
     * Handle the Submission "creating" event.
     */
    public function creating(Submission $submission): void
    {
        $submission->file = $submission->file
            ? File::saveSingleFile(UploadFileType::FILE, $submission->file)
            : null;
    }

    /**
     * Handle the Submission "updating" event.
     */
    public function updating(Submission $submission): void
    {
        if ($submission->isDirty('file')) {
            $oldFile = $submission->getOriginal('file', null);

            if ($oldFile == null) {
                $submission->file = $submission->file
                    ? File::saveSingleFile(UploadFileType::FILE, $submission->file)
                    : null;
            } else {
                $submission->file = $submission->file
                    ? File::updateSingleFile(UploadFileType::FILE, $submission->file, $oldFile)
                    : File::deleteFile(UploadFileType::FILE, $oldFile);
            }
        }
    }

    /**
     * Handle the Submission "deleting" event.
     */
    public function deleting(Submission $submission): void
    {
        $submission->file
            ? File::deleteFile(UploadFileType::FILE, $submission->file)
            : null;
    }
}
