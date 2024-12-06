<?php

namespace App\Http\Requests\Admin\Sponsorship;

use App\Enums\CustomValidationType;
use App\Models\Sponsorship;
use App\Models\SponsorshipTier;
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
            'name' => ['required', 'string', 'max:50', Rule::unique(Sponsorship::class, 'name')->ignore($this->sponsorship)],
            'logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'link' => ['required', 'url', 'max:255'],
            'tier_id' => ['required', 'string', Rule::exists(SponsorshipTier::class, 'id')],
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
            'name.required' => 'Nama sponsor tidak boleh kosong',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'logo.image' => 'Logo sponsor harus berupa gambar',
            'logo.mimes' => 'Logo sponsor harus berupa gambar dengan format '.$imageMimeType.'.',
            'logo.extensions' => 'Logo sponsor harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'logo.max' => 'Logo sponsor tidak boleh lebih dari '.$imageMaxSize.'.',
            'link.required' => 'Link sponsor tidak boleh kosong',
            'link.url' => 'Link sponsor harus berupa url',
            'link.max' => 'Link sponsor tidak boleh lebih dari 255 karakter.',
            'tier_id.required' => 'Level sponsor tidak boleh kosong',
            'tier_id.string' => 'Level sponsor harus berupa string.',
            'tier_id.exists' => 'Level sponsor tidak ditemukan.',
        ];
    }
}
