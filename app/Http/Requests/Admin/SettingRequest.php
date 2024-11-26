<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'slogan' => ['required', 'string'],
            'heading' => ['required', 'string'],
            'description' => ['required', 'string'],
            'nav_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'phone' => ['required', 'string'],
            'instagram' => ['required', 'string'],
            'video_tutorial' => ['required', 'url'],
            'deadline' => ['required', 'string'],
            'twibbon' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'twibbon_link' => ['required', 'string'],
            'mascot' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'primary_color' => ['required', 'string'],
            'primary_color_hover' => ['required', 'string'],
            'secondary_color' => ['required', 'string'],
        ];
    }
}
