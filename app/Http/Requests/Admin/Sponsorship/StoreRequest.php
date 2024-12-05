<?php

namespace App\Http\Requests\Admin\Sponsorship;

use App\Models\Sponsorship;
use App\Models\SponsorshipTier;
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
            'name' => ['required', 'string', 'max:50', Rule::unique(Sponsorship::class, 'name')],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'link' => ['required', 'url', 'max:255'],
            'tier_id' => ['required', 'string', Rule::exists(SponsorshipTier::class, 'id')],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama sponsor tidak boleh kosong',
            'name.string' => 'Nama sponsor harus berupa string.',
            'name.max' => 'Nama sponsor tidak boleh lebih dari 50 karakter.',
            'name.unique' => 'Nama sponsor sudah ada.',
            'logo.required' => 'Logo sponsor tidak boleh kosong',
            'logo.image' => 'Logo sponsor harus berupa gambar',
            'logo.mimes' => 'Logo sponsor harus berupa gambar dengan format jpeg, png, atau jpg.',
            'logo.extensions' => 'Logo sponsor harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'logo.max' => 'Logo sponsor tidak boleh lebih dari 8MB',
            'link.required' => 'Link sponsor tidak boleh kosong',
            'link.url' => 'Link sponsor harus berupa url',
            'link.max' => 'Link sponsor tidak boleh lebih dari 255 karakter.',
            'tier_id.required' => 'Level sponsor tidak boleh kosong',
            'tier_id.string' => 'Level sponsor harus berupa string.',
            'tier_id.exists' => 'Level sponsor tidak ditemukan.',
        ];
    }
}
