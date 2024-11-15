<?php

namespace App\Http\Requests\Admin\Timeline;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date', 'after_or_equal:' . now()]
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
            'title.required'        => 'Nama Schedule timeline harus diisi.',
            'title.string'          => 'Nama Schedule timeline harus berupa string.',
            'title.max'             => 'Nama Schedule timeline tidak boleh lebih dari 100 karakter.',
            'description.required'  => 'Deskripsi timeline harus diisi.',
            'description.string'    => 'Deskripsi timeline harus berupa string.',
            'date.required'         => 'Tanggal timeline harus diisi.',
            'date.date'             => 'Format tanggal tidak sesuai.',
            'date.after_or_equal'   => 'Tanggal timeline harus sama atau lebih dari tanggal sekarang.',
        ];
    }
}
