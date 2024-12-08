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

}
