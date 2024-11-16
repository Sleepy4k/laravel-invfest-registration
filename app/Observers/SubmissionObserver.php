<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Models\Submission;
use App\Traits\UploadFile;
use Illuminate\Support\Str;

class SubmissionObserver
{
    use UploadFile;

    /**
     * Handle the Submission "creating" event.
     */
    public function creating(Submission $submission): void
    {
        if ($submission->getKey() === null) {
            $submission->setAttribute($submission->getKeyName(), Str::uuid());
        }

        $submission->file = $submission->file
            ? $this->saveSingleFile(UploadFileType::IMAGE, $submission->file)
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
                    ? $this->saveSingleFile(UploadFileType::IMAGE, $submission->file)
                    : null;
            } else {
                $submission->file = $submission->file
                    ? $this->updateSingleFile(UploadFileType::IMAGE, $submission->file, $oldFile)
                    : $this->deleteFile(UploadFileType::IMAGE, $oldFile);
            }
        }
    }

    /**
     * Handle the Submission "deleting" event.
     */
    public function deleting(Submission $submission): void
    {
        $submission->file
            ? $this->deleteFile(UploadFileType::IMAGE, $submission->file)
            : null;
    }
}
