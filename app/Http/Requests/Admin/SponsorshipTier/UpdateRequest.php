<?php

namespace App\Http\Requests\Admin\SponsorshipTier;

use App\Models\SponsorshipTier;
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
            'tier' => ['required', 'string', 'max:50', Rule::unique(SponsorshipTier::class, 'tier')->ignore($this->tier)],
        ];
    }
}
