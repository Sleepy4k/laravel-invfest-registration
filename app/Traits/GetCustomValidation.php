<?php

namespace App\Traits;

use App\Enums\CustomValidationType;
use Illuminate\Support\Facades\File;

trait GetCustomValidation
{
    /**
     * @var array
     */
    protected array $validations = [];

    /**
     * Read json file and return the content
     *
     * @param string $path
     *
     * @return array
     */
    protected function readJsonFile(string $path): array
    {
        if (empty($this->validations)) {
            $this->validations = json_decode(File::get($path), true);
        }

        return $this->validations;
    }

    /**
     * Get the validation rules from the request-settings.json file
     *
     * @param CustomValidationType $key
     * @param string $default
     *
     * @return string
     */
    protected function getValidationRules(CustomValidationType $key, string $default): string
    {
        $settings = $this->readJsonFile(storage_path('request-settings.json'));
        return $settings[$key->value] ?? $default;
    }

    /**
     * Get the validation message from the request-settings.json file
     *
     * @param CustomValidationType $key
     * @param string $default
     *
     * @return string
     */
    protected function getValidationMessage(CustomValidationType $key, string $default): string
    {
        $settings = $this->readJsonFile(storage_path('request-settings.json'));

        // If key include '_size' then return the message with the size value
        if (strpos($key->value, '_size') !== false) {
            $size = $settings[$key] ?? 8192;
            $formattedSize = $size * 1024;

            return formatFileSize($formattedSize) ?? $default;
        }

        // If key include '_mimes' then return the message with the mimes value
        // so when data like 'pdf,doc,docx' will be converted to 'pdf, doc, atau docx'
        // for the last data always add 'atau' before the last data if the data more than 1
        if (strpos($key->value, '_mimes') !== false) {
            $mimes = isset($settings[$key]) && is_string($settings[$key]) ? explode(',', $settings[$key]) : [];
            $message = '';

            foreach ($mimes as $index => $mime) {
                if ($index === 0) {
                    $message .= $mime;
                } elseif ($index === count($mimes) - 1) {
                    $message .= ' atau ' . $mime;
                } else {
                    $message .= ', ' . $mime;
                }
            }

            return $message ?? $default;
        }

        return $settings[$key] ?? $default;
    }
}
