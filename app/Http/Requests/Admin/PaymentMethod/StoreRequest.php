<?php

namespace App\Http\Requests\Admin\PaymentMethod;

use App\Enums\CustomValidationType;
use App\Models\PaymentMethod;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', Rule::unique(PaymentMethod::class, 'name')],
            'logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'number' => ['required', 'string', 'max:50'],
            'owner' => ['required', 'string', 'max:150'],
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
            'name.required' => 'Nama media partner tidak boleh kosong',
            'name.string' => 'Nama media partner harus berupa string.',
            'name.max' => 'Nama media partner tidak boleh lebih dari 50 karakter.',
            'name.unique' => 'Nama media partner sudah ada.',
            'logo.image' => 'Logo media partner harus berupa gambar',
            'logo.mimes' => 'Logo media partner harus berupa gambar dengan format '.$imageMimeType.'.',
            'logo.extensions' => 'Logo media partner harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'logo.max' => 'Logo media partner tidak boleh lebih dari '.$imageMaxSize.'.',
            'number.required' => 'Nomor rekening metode pembayaran tidak boleh kosong',
            'number.string' => 'Nomor rekening metode pembayaran harus berupa string.',
            'number.max' => 'Nomor rekening metode pembayaran tidak boleh lebih dari 50 karakter.',
            'owner.required' => 'Nama pemilik rekening metode pembayaran tidak boleh kosong',
            'owner.string' => 'Nama pemilik rekening metode pembayaran harus berupa string.',
            'owner.max' => 'Nama pemilik rekening metode pembayaran tidak boleh lebih dari 150 karakter.',
        ];
    }
}
