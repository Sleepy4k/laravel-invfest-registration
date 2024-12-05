<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\Submission;
use App\Traits\UploadFile;

class SubmissionObserver
{
    use UploadFile;

    /**
     * Handle the Submission "creating" event.
     */
    public function creating(Submission $submission): void
    {
        $submission->file = $submission->file
            ? $this->saveSingleFile(UploadFileType::FILE, $submission->file)
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
                    ? $this->saveSingleFile(UploadFileType::FILE, $submission->file)
                    : null;
            } else {
                $submission->file = $submission->file
                    ? $this->updateSingleFile(UploadFileType::FILE, $submission->file, $oldFile)
                    : $this->deleteFile(UploadFileType::FILE, $oldFile);
            }
        }
    }

    /**
     * Handle the Submission "deleting" event.
     */
    public function deleting(Submission $submission): void
    {
        $submission->file
            ? $this->deleteFile(UploadFileType::FILE, $submission->file)
            : null;
    }
}
