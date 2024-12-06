<?php

namespace App\Http\Requests\Auth;

use App\Enums\CustomValidationType;
use App\Rules\MinimumTeamMember;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'data' => ['required', 'array', new MinimumTeamMember],
            'data.*.member' => ['nullable', 'string', 'max:150'],
            'data.*.card' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $imageMimeType = $this->getValidationMessage(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationMessage(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'data.required' => 'Data array is required.',
            'data.*.member.string' => 'Anggota tim harus berupa string.',
            'data.*.member.max' => 'Anggota tim tidak boleh melebihi 150 karakter.',
            'data.*.card.image' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar.',
            'data.*.card.mimes' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar dengan format '.$imageMimeType.'.',
            'data.*.card.extensions' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'data.*.card.max' => 'Kartu pelajar/kartu mahasiswa anggota tim tidak boleh lebih dari '.$imageMaxSize.'.',
        ];
    }
}
