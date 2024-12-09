<?php

namespace App\Http\Requests\Admin\Sponsorship;

use App\Enums\CustomValidationType;
use App\Models\Sponsorship;
use App\Models\SponsorshipTier;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', Rule::unique(Sponsorship::class, 'name')->ignore($this->sponsor)],
            'logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'link' => ['required', 'url', 'max:255'],
            'tier_id' => ['required', 'string', Rule::exists(SponsorshipTier::class, 'id')],
        ];
    }
}
