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
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $imageMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);
        $fileMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'doc,docx,pdf');
        $fileMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'name.required' => 'Nama kompetisi harus diisi.',
            'name.string' => 'Nama kompetisi harus berupa string.',
            'name.max' => 'Nama kompetisi tidak boleh lebih dari 150 karakter.',
            'name.unique' => 'Nama kompetisi sudah ada.',
            'slug.required' => 'Nama kompetisi harus diisi.',
            'slug.string' => 'Nama kompetisi harus berupa string.',
            'slug.unique' => 'Nama kompetisi sudah ada.',
            'level_id.required' => 'Tingkat kompetisi harus diisi.',
            'level_id.string' => 'Tingkat kompetisi harus berupa string.',
            'level_id.exists' => 'Tingkat kompetisi tidak ditemukan.',
            'description.required' => 'Deskripsi kompetisi harus diisi.',
            'description.string' => 'Deskripsi kompetisi harus berupa string.',
            'poster.required' => 'Poster kompetisi tidak boleh kosong',
            'poster.image' => 'Poster kompetisi harus berupa gambar',
            'poster.mimes' => 'Poster kompetisi harus berupa gambar dengan format '.$imageMimeType.'.',
            'poster.extensions' => 'Poster kompetisi harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'poster.max' => 'Poster kompetisi tidak boleh lebih dari '.$imageMaxSize.'.',
            'guidebook.required' => 'Guidebook kompetisi tidak boleh kosong',
            'guidebook.file' => 'Guidebook kompetisi harus berupa file',
            'guidebook.mimes' => 'Guidebook kompetisi harus berupa file dengan format '.$fileMimeType.'.',
            'guidebook.extensions' => 'Guidebook kompetisi harus berupa file dengan ekstensi file '.$fileMimeType.'.',
            'guidebook.max' => 'Guidebook kompetisi tidak boleh lebih dari '.$fileMaxSize.'.',
            'registration_fee.required' => 'Biaya pendaftaran kompetisi harus diisi.',
            'registration_fee.numeric' => 'Biaya pendaftaran kompetisi harus berupa angka.',
            'whatsapp_group.required' => 'Link grup WhatsApp kompetisi harus diisi.',
            'whatsapp_group.string' => 'Link grup WhatsApp kompetisi harus berupa string.',
            'whatsapp_group.max' => 'Link grup WhatsApp kompetisi tidak boleh lebih dari 255 karakter.',
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
