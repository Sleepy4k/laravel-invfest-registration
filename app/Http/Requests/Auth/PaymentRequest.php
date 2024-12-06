<?php

namespace App\Http\Requests\Auth;

use App\Enums\CustomValidationType;
use App\Models\PaymentMethod;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
            'payment_method_id' => ['required', Rule::exists(PaymentMethod::class, 'id')],
            'proof' => ['required', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
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
            'payment_method_id.required' => 'Metode pembayaran harus dipilih.',
            'payment_method_id.exists' => 'Metode pembayaran tidak ditemukan.',
            'proof.required' => 'Bukti pembayaran harus diunggah.',
            'proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'proof.mimes' => 'Bukti pembayaran harus berupa gambar dengan format '.$imageMimeType.'.',
            'proof.extensions' => 'Bukti pembayaran harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'proof.max' => 'Bukti pembayaran tidak boleh lebih dari '.$imageMaxSize.'.',
        ];
    }
}
