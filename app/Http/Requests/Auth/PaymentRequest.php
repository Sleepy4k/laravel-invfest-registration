<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'proof' => ['required', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
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
            'payment_method_id.required' => 'Metode pembayaran harus dipilih.',
            'payment_method_id.exists' => 'Metode pembayaran tidak ditemukan.',
            'proof.required' => 'Bukti pembayaran harus diunggah.',
            'proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'proof.mimes' => 'Bukti pembayaran harus berupa gambar dengan format jpg, jpeg, atau png.',
            'proof.extensions' => 'Bukti pembayaran harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'proof.max' => 'Bukti pembayaran tidak boleh lebih dari 8 MB.',
        ];
    }
}
