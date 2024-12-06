<?php

namespace App\Http\Requests\Admin\MediaPartner;

use App\Enums\CustomValidationType;
use App\Models\MediaPartner;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', Rule::unique(MediaPartner::class, 'name')->ignore($this->media_partner)],
            'logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'link' => ['nullable', 'url', 'max:255']
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        $imageMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'name.required' => 'Nama media partner tidak boleh kosong',
            'name.string' => 'Nama media partner harus berupa string.',
            'name.max' => 'Nama media partner tidak boleh lebih dari 50 karakter.',
            'name.unique' => 'Nama media partner sudah ada.',
            'logo.image' => 'Logo media partner harus berupa gambar',
            'logo.mimes' => 'Logo media partner harus berupa gambar dengan format '.$imageMimeType.'.',
            'logo.extensions' => 'Logo media partner harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'logo.max' => 'Logo media partner tidak boleh lebih dari '.$imageMaxSize.'.',
            'link.url' => 'Link media partner harus berupa url',
            'link.max' => 'Link media partner tidak boleh lebih dari 255 karakter.',
        ];
    }
}
