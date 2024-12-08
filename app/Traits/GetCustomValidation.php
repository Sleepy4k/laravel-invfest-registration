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
}
