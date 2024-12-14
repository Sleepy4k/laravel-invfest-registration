<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Setting;

class SettingObserver
{
    /**
     * Handle the Setting "creating" event.
     */
    public function creating(Setting $setting): void
    {
        if (in_array(strtolower($setting->key), ['nav_logo', 'twibbon', 'mascot'])) {
            $setting->value = $setting->value
                ? File::saveSingleFile(UploadFileType::IMAGE, $setting->value)
                : null;
        }
    }

    /**
     * Handle the Setting "updating" event.
     */
    public function updating(Setting $setting): void
    {
        if (in_array(strtolower($setting->key), ['nav_logo', 'twibbon', 'mascot'])) {
            if ($setting->isDirty('value')) {
                $oldValue = $setting->getOriginal('value', null);

                if ($oldValue == null) {
                    $setting->value = $setting->value
                        ? File::saveSingleFile(UploadFileType::IMAGE, $setting->value)
                        : null;
                } else {
                    $setting->value = $setting->value
                        ? File::updateSingleFile(UploadFileType::IMAGE, $setting->value, $oldValue)
                        : File::deleteFile(UploadFileType::IMAGE, $oldValue);
                }
            }
        }
    }

    /**
     * Handle the Setting "deleting" event.
     */
    public function deleting(Setting $setting): void
    {
        if (in_array(strtolower($setting->key), ['nav_logo', 'twibbon', 'mascot'])) {
            $setting->value
                ? File::deleteFile(UploadFileType::IMAGE, $setting->value)
                : null;
        }
    }
}
