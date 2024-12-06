<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestSettingRequest extends FormRequest
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
            'image_mimes' => ['required', 'string'],
            'image_max_size' => ['required', 'numeric'],
            'document_mimes' => ['required', 'string'],
            'document_max_size' => ['required', 'numeric'],
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
            'image_mimes.required' => 'Tipe file gambar wajib diisi.',
            'image_mimes.string' => 'Tipe file gambar harus berupa string.',
            'image_max_size.required' => 'Ukuran maksimal file gambar wajib diisi.',
            'image_max_size.numeric' => 'Ukuran maksimal file gambar harus berupa angka.',
            'document_mimes.required' => 'Tipe file dokumen wajib diisi.',
            'document_mimes.string' => 'Tipe file dokumen harus berupa string.',
            'document_max_size.required' => 'Ukuran maksimal file dokumen wajib diisi.',
            'document_max_size.numeric' => 'Ukuran maksimal file dokumen harus berupa angka.',
        ];
    }
}
