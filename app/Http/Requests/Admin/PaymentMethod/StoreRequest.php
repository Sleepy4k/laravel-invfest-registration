<?php

namespace App\Http\Requests\Admin\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg,gif,svg', 'max:8192'],
            'number' => ['required', 'string', 'max:50'],
            'owner' => ['required', 'string', 'max:150'],
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
            'logo.required' => 'Logo media partner tidak boleh kosong',
            'logo.image' => 'Logo media partner harus berupa gambar',
            'logo.mimes' => 'Logo media partner harus berupa gambar dengan format jpeg, png, atau jpg.',
            'logo.extensions' => 'Logo media partner harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'logo.max' => 'Logo media partner tidak boleh lebih dari 8MB',
            'number.required' => 'Nomor rekening metode pembayaran tidak boleh kosong',
            'number.string' => 'Nomor rekening metode pembayaran harus berupa string.',
            'number.max' => 'Nomor rekening metode pembayaran tidak boleh lebih dari 50 karakter.',
            'owner.required' => 'Nama pemilik rekening metode pembayaran tidak boleh kosong',
            'owner.string' => 'Nama pemilik rekening metode pembayaran harus berupa string.',
            'owner.max' => 'Nama pemilik rekening metode pembayaran tidak boleh lebih dari 150 karakter.',
        ];
    }
}
