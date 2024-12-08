<?php

namespace App\Http\Requests\Auth;

use App\Enums\CustomValidationType;
use App\Models\Competition;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    use GetCustomValidation;

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
        $imageMimeType = $this->getValidationRules(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationRules(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'competition_id' => ['required', 'string', Rule::exists(Competition::class, 'id')],
            'team_name' => ['required', 'string', 'max:100'],
            'institution' => ['required', 'string', 'max:150'],
            'leader_name' => ['required', 'string', 'max:150'],
            'leader_phone' => ['required', 'string', 'max:50'],
            'leader_card' => ['required', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'companion_name' => ['nullable', 'string', 'max:150'],
            'companion_card' => ['required_unless:companion_name,null', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'email' => ['required', 'email:rfc,filter', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
