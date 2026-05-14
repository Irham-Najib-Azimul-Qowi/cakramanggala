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
            'nim' => 'required|string|max:50|unique:pendaftaran,nim',
            'no_hp' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jurusan' => 'required|in:Teknik,Administrasi Bisnis,Akuntansi',
            'program_studi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'organisasi_yang_pernah_diikuti' => 'nullable|string',
            'alasan_bergabung' => 'required|string|min:20',
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nim.unique' => 'NIM ini sudah terdaftar dalam sistem kami.',
            'alasan_bergabung.min' => 'Alasan bergabung minimal 20 karakter agar kami bisa mengenal motivasi Anda lebih baik.',
            'foto_diri.image' => 'File harus berupa gambar.',
            'foto_diri.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_diri.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
