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
        $fileMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'doc,docx,pdf');
        $fileMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'title' => ['required', 'string', 'max:200'],
            'zip_file' => ['required', 'file', 'mimes:'.$fileMimeType, 'extensions:'.$fileMimeType, 'max:'.$fileMaxSize],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $fileMimeType = $this->getValidationMessage(CustomValidationType::IMAGE_MIMES, 'doc,docx,pdf');
        $fileMaxSize = $this->getValidationMessage(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'title.required' => 'Judul karya tidak boleh kosong.',
            'title.string' => 'Judul karya harus berupa string.',
            'title.max' => 'Judul karya tidak boleh lebih dari 200 karakter.',
            'zip_file.required' => 'File karya tidak boleh kosong.',
            'zip_file.file' => 'File karya harus berupa file.',
            'zip_file.mimes' => 'File karya harus berupa file dengan format '.$fileMimeType.'.',
            'zip_file.extensions' => 'File karya harus berupa file dengan ekstensi file '.$fileMimeType.'.',
            'zip_file.max' => 'File karya tidak boleh lebih dari '.$fileMaxSize.'.',
        ];
    }
}
