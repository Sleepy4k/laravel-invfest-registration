<?php

namespace App\Http\Requests\Auth;

use App\Enums\CustomValidationType;
use App\Rules\MinimumTeamMember;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'data' => ['required', 'array', new MinimumTeamMember],
            'data.*.member' => ['nullable', 'string', 'max:150'],
            'data.*.card' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
        ];
    }
}
