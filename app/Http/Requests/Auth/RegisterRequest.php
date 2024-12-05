<?php

namespace App\Http\Requests\Auth;

use App\Models\Competition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
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
        return [
            'competition_id' => ['required', 'string', Rule::exists(Competition::class, 'id')],
            'team_name' => ['required', 'string', 'max:100'],
            'institution' => ['required', 'string', 'max:150'],
            'leader_name' => ['required', 'string', 'max:150'],
            'leader_phone' => ['required', 'string', 'max:50'],
            'leader_card' => ['required', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'companion_name' => ['nullable', 'string', 'max:150'],
            'companion_card' => ['required_unless:companion_name,null', 'image', 'mimes:png,jpg,jpeg', 'extensions:png,jpg,jpeg', 'max:8192'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'competition_id.required' => 'Lomba harus dipilih.',
            'competition_id.string' => 'Lomba harus berupa string.',
            'competition_id.exists' => 'Lomba tidak ditemukan.',
            'team_name.required' => 'Nama tim harus diisi.',
            'team_name.string' => 'Nama tim harus berupa string.',
            'team_name.max' => 'Nama tim tidak boleh lebih dari 100 karakter.',
            'institution.required' => 'Asal sekolah/perguruan tinggi harus diisi.',
            'institution.string' => 'Asal sekolah/perguruan tinggi harus berupa string.',
            'institution.max' => 'Asal sekolah/perguruan tinggi maksimal 150 karakter.',
            'leader_name.required' => 'Nama ketua tim harus diisi.',
            'leader_name.string' => 'Nama ketua tim harus berupa string.',
            'leader_name.max' => 'Nama ketua tim tidak boleh lebih dari 150 karakter.',
            'leader_phone.required' => 'Nomor telepon ketua tim harus diisi.',
            'leader_phone.string' => 'Nomor telepon ketua tim harus berupa string.',
            'leader_phone.max' => 'Nomor telepon ketua tim tidak boleh lebih dari 50 karakter.',
            'leader_card.required' => 'Kartu pelajar/kartu mahasiswa ketua tim harus diunggah.',
            'leader_card.image' => 'Kartu pelajar/kartu mahasiswa ketua tim harus berupa gambar.',
            'leader_card.mimes' => 'Kartu pelajar/kartu mahasiswa ketua tim harus berupa gambar dengan format jpg, jpeg, atau png.',
            'leader_card.extensions' => 'Kartu pelajar/kartu mahasiswa ketua tim harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'leader_card.max' => 'Kartu pelajar/kartu mahasiswa ketua tim tidak boleh lebih dari 8 MB.',
            'companion_name.string' => 'Nama pendamping tim harus berupa string.',
            'companion_card.required_unless' => 'Kartu pendamping tim harus berupa di diunggah jika melampirkan pendamping tim.',
            'companion_card.image' => 'Kartu pendamping tim harus berupa gambar.',
            'companion_card.mimes' => 'Kartu pendamping tim harus berupa gambar dengan format jpg, jpeg, atau png.',
            'companion_card.extensions' => 'Kartu pendamping tim harus berupa gambar dengan ekstensi file jpg, jpeg, atau png.',
            'companion_card.max' => 'Kartu pendamping tim tidak boleh lebih dari 8 MB.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Password tidak cocok.',
        ];
    }
}
