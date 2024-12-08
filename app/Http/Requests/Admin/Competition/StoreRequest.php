<?php

namespace App\Http\Requests\Admin\Competition;

use App\Enums\CustomValidationType;
use App\Models\Competition;
use App\Models\CompetitionLevel;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $fileMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'doc,docx,pdf');
        $fileMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'name' => ['required', 'string', 'max:150', Rule::unique(Competition::class, 'name')],
            'slug' => ['required', 'string', 'max:150', Rule::unique(Competition::class, 'slug')],
            'level_id' => ['required', 'string', Rule::exists(CompetitionLevel::class, 'id')],
            'description' => ['required', 'string'],
            'poster' => ['required', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'guidebook' => ['required', 'file', 'mimes:'.$fileMimeType, 'extensions:'.$fileMimeType, 'max:'.$fileMaxSize],
            'registration_fee' => ['required', 'numeric'],
            'whatsapp_group' => ['required', 'string', 'max:255']
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
