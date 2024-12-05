<?php

namespace App\Http\Requests\Admin;

use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'status' => ['required', Rule::enum(PaymentStatus::class)->only([PaymentStatus::APPROVE, PaymentStatus::REJECT])],
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
            'whatsapp_link' => ['nullable', 'string', Rule::requiredIf(fn () => request()->input('status') === PaymentStatus::APPROVE->value)]
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
            'status.required' => 'Status diperlukan.',
            'status.in' => 'Status harus berupa: Approve atau Reject.',
            'email.required' => 'Email diperlukan.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.exists' => 'Email tidak ditemukan di database pengguna.',
            'whatsapp_link.required_if' => 'Tautan WhatsApp diperlukan ketika status adalah Approve.',
            'whatsapp_link.string' => 'Tautan WhatsApp harus berupa string.',
        ];
    }
}
