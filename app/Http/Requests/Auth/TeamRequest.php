<?php

namespace App\Http\Requests\Auth;

use App\Rules\MinimumTeamMember;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
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
        return [
            'data' => ['required', 'array', new MinimumTeamMember],
            'data.*.member' => ['nullable', 'string', 'max:150'],
            'data.*.card' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data.required' => 'Data array is required.',
            'data.*.member.string' => 'Anggota tim harus berupa string.',
            'data.*.member.max' => 'Anggota tim tidak boleh melebihi 150 karakter.',
            'data.*.card.image' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar.',
            'data.*.card.mimes' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar dengan format jpg, jpeg, atau png.',
            'data.*.card.extensions' => 'Kartu pelajar/kartu mahasiswa anggota tim harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'data.*.card.max' => 'Kartu pelajar/kartu mahasiswa anggota tim tidak boleh lebih dari 8 MB.',
        ];
    }
}
