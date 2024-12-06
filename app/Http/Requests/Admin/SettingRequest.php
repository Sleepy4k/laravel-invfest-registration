<?php

namespace App\Http\Requests\Admin;

use App\Enums\CustomValidationType;
use App\Traits\GetCustomValidation;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'slogan' => ['required', 'string'],
            'heading' => ['required', 'string'],
            'description' => ['required', 'string'],
            'nav_logo' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'phone' => ['required', 'string'],
            'instagram' => ['required', 'string'],
            'video_tutorial' => ['required', 'url'],
            'deadline' => ['required', 'string'],
            'twibbon' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'twibbon_link' => ['required', 'string'],
            'mascot' => ['nullable', 'image', 'mimes:'.$imageMimeType, 'extensions:'.$imageMimeType, 'max:'.$imageMaxSize],
            'primary_color' => ['required', 'string'],
            'primary_color_hover' => ['required', 'string'],
            'secondary_color' => ['required', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        $imageMimeType = $this->getValidationMessage(CustomValidationType::IMAGE_MIMES, 'png,jpg,jpeg');
        $imageMaxSize = $this->getValidationMessage(CustomValidationType::IMAGE_MAX_SIZE, 8192);

        return [
            'title.required' => 'Judul tidak boleh kosong',
            'title.string' => 'Judul harus berupa string.',
            'slogan.required' => 'Slogan tidak boleh kosong',
            'slogan.string' => 'Slogan harus berupa string.',
            'heading.required' => 'Heading tidak boleh kosong',
            'heading.string' => 'Heading harus berupa string.',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa string.',
            'nav_logo.image' => 'Logo navigasi harus berupa gambar',
            'nav_logo.mimes' => 'Logo navigasi harus berupa gambar dengan format '.$imageMimeType.'.',
            'nav_logo.extensions' => 'Logo navigasi harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'nav_logo.max' => 'Logo navigasi tidak boleh lebih dari '.$imageMaxSize.'.',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'instagram.required' => 'Instagram tidak boleh kosong',
            'instagram.string' => 'Instagram harus berupa string.',
            'video_tutorial.required' => 'Video tutorial tidak boleh kosong',
            'video_tutorial.url' => 'Video tutorial harus berupa url',
            'deadline.required' => 'Deadline tidak boleh kosong',
            'deadline.string' => 'Deadline harus berupa string.',
            'twibbon.image' => 'Twibbon harus berupa gambar',
            'twibbon.mimes' => 'Twibbon harus berupa gambar dengan format '.$imageMimeType.'.',
            'twibbon.extensions' => 'Twibbon harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'twibbon.max' => 'Twibbon tidak boleh lebih dari '.$imageMaxSize.'.',
            'twibbon_link.required' => 'Link twibbon tidak boleh kosong',
            'twibbon_link.string' => 'Link twibbon harus berupa string.',
            'mascot.image' => 'Mascot harus berupa gambar',
            'mascot.mimes' => 'Mascot harus berupa gambar dengan format '.$imageMimeType.'.',
            'mascot.extensions' => 'Mascot harus berupa gambar dengan ekstensi file '.$imageMimeType.'.',
            'mascot.max' => 'Mascot tidak boleh lebih dari '.$imageMaxSize.'.',
            'primary_color.required' => 'Warna primer tidak boleh kosong',
            'primary_color.string' => 'Warna primer harus berupa string.',
            'primary_color_hover.required' => 'Warna primer hover tidak boleh kosong',
            'primary_color_hover.string' => 'Warna primer hover harus berupa string.',
            'secondary_color.required' => 'Warna sekunder tidak boleh kosong',
            'secondary_color.string' => 'Warna sekunder harus berupa string.',
        ];
    }
}
