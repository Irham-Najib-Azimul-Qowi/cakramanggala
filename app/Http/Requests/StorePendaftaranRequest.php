<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email',
            'nim' => 'nullable|string|max:50',
            'no_hp' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jurusan' => 'required|in:Teknik,Administrasi Bisnis,Akuntansi',
            'program_studi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'organisasi_yang_pernah_diikuti' => 'nullable|string',
            'alasan_bergabung' => 'required|string|min:20',
            'foto_diri' => 'required|custom_image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar dalam sistem kami.',
            'alasan_bergabung.min' => 'Alasan bergabung minimal 20 karakter agar kami bisa mengenal motivasi Anda lebih baik.',
            'foto_diri.image' => 'File harus berupa gambar.',
            'foto_diri.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_diri.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
