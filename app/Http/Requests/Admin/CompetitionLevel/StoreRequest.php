<?php

namespace App\Http\Requests\Admin\CompetitionLevel;

use App\Models\CompetitionLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'level' => ['required', 'string', 'max:30', Rule::unique(CompetitionLevel::class, 'level')],
            'display_as' => ['required', 'string', 'max:150'],
        ];
    }
}
