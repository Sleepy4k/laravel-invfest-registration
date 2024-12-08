<?php

namespace App\Http\Requests\Admin\PaymentMethod;

use App\Enums\CustomValidationType;
use App\Models\PaymentMethod;
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
            'name' => ['required', 'string', 'max:50', Rule::unique(PaymentMethod::class, 'name')->ignore($this->payment_method)],
            'logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'number' => ['required', 'string', 'max:50'],
            'owner' => ['required', 'string', 'max:150'],
        ];
    }
}
