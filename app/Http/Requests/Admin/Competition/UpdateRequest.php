<?php

namespace App\Http\Requests\Admin\Competition;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'name' => ['required', 'string', 'max:150'],
            'level_id' => ['required', 'string', 'exists:competition_levels,id'],
            'description' => ['required', 'string'],
            'poster' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'guidebook' => ['nullable', 'file', 'mimes:doc,docx,pdf', 'extensions:doc,docx,pdf', 'max:8192'],
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
        return [
            'name.required' => 'Nama kompetisi harus diisi.',
            'name.string' => 'Nama kompetisi harus berupa string.',
            'name.max' => 'Nama kompetisi tidak boleh lebih dari 150 karakter.',
            'slug.required' => 'Nama kompetisi harus diisi.',
            'slug.string' => 'Nama kompetisi harus berupa string.',
            'slug.unique' => 'Nama kompetisi sudah ada.',
            'level_id.required' => 'Tingkat kompetisi harus diisi.',
            'level_id.string' => 'Tingkat kompetisi harus berupa string.',
            'level_id.exists' => 'Tingkat kompetisi tidak ditemukan.',
            'description.required' => 'Deskripsi kompetisi harus diisi.',
            'description.string' => 'Deskripsi kompetisi harus berupa string.',
            'poster.image' => 'Poster kompetisi harus berupa gambar',
            'poster.mimes' => 'Poster kompetisi harus berupa gambar dengan format jpeg, png, atau jpg.',
            'poster.extensions' => 'Poster kompetisi harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'poster.max' => 'Poster kompetisi tidak boleh lebih dari 8MB',
            'guidebook.file' => 'Guidebook kompetisi harus berupa file',
            'guidebook.mimes' => 'Guidebook kompetisi harus berupa file dengan format doc, docx, atau pdf.',
            'guidebook.extensions' => 'Guidebook kompetisi harus berupa file dengan ekstensi file doc, docx, atau pdf.',
            'guidebook.max' => 'Guidebook kompetisi tidak boleh lebih dari 8MB',
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
