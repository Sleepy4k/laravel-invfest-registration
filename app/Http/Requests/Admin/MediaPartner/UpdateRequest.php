<?php

namespace App\Http\Requests\Admin\MediaPartner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'extensions:png,jpg,jpeg,gif,svg', 'max:8192'],
            'link' => ['required', 'url', 'max:255']
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama media partner tidak boleh kosong',
            'name.string' => 'Nama media partner harus berupa string.',
            'name.max' => 'Nama media partner tidak boleh lebih dari 50 karakter.',
            'logo.image' => 'Logo media partner harus berupa gambar',
            'logo.mimes' => 'Logo media partner harus berupa gambar dengan format jpeg, png, jpg, gif, atau svg',
            'logo.extensions' => 'Logo media partner harus berupa gambar dengan ekstensi file jpg, jpeg, png, gif, atau svg.',
            'logo.max' => 'Logo media partner tidak boleh lebih dari 8MB',
            'link.required' => 'Link media partner tidak boleh kosong',
            'link.url' => 'Link media partner harus berupa url',
            'link.max' => 'Link media partner tidak boleh lebih dari 255 karakter.',
        ];
    }
}
