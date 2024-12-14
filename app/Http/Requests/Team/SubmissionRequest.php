<?php

namespace App\Http\Requests\Team;

use App\Enums\CustomValidationType;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
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
        $fileMimeType = $this->getValidationRules(CustomValidationType::FILE_MIMES, 'doc,docx,pdf');
        $fileMaxSize = $this->getValidationRules(CustomValidationType::FILE_MAX_SIZE, 8192);

        return [
            'title' => ['required', 'string', 'max:200'],
            'zip_file' => ['required', 'file', 'mimes:'.$fileMimeType, 'extensions:'.$fileMimeType, 'max:'.$fileMaxSize],
        ];
    }
}
