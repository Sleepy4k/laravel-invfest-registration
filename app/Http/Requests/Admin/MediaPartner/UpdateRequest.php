<?php

namespace App\Http\Requests\Admin\MediaPartner;

use App\Models\MediaPartner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', 'max:50', Rule::unique(MediaPartner::class, 'name')->ignore($this->media_partner)],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'link' => ['nullable', 'url', 'max:255']
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
            'name.unique' => 'Nama media partner sudah ada.',
            'logo.image' => 'Logo media partner harus berupa gambar',
            'logo.mimes' => 'Logo media partner harus berupa gambar dengan format jpeg, png, atau jpg.',
            'logo.extensions' => 'Logo media partner harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'logo.max' => 'Logo media partner tidak boleh lebih dari 8MB',
            'link.url' => 'Link media partner harus berupa url',
            'link.max' => 'Link media partner tidak boleh lebih dari 255 karakter.',
        ];
    }
}
