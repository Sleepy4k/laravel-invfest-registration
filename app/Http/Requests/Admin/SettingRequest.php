<?php

namespace App\Http\Requests\Admin;

use App\Enums\CustomValidationType;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    use GetCustomValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'title' => ['required', 'string'],
            'slogan' => ['required', 'string'],
            'heading' => ['required', 'string'],
            'description' => ['required', 'string'],
            'nav_logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'phone' => ['required', 'string'],
            'instagram' => ['required', 'string'],
            'video_tutorial' => ['required', 'url'],
            'deadline' => ['required', 'string'],
            'twibbon' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'twibbon_link' => ['required', 'string'],
            'mascot' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'primary_color' => ['required', 'string'],
            'primary_color_hover' => ['required', 'string'],
            'secondary_color' => ['required', 'string'],
        ];
    }
}
