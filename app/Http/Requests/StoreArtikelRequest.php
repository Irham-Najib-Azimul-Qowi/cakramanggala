<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:200',
            'konten' => 'required|string',
            'excerpt' => 'nullable|string|max:300',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp,heic,heif|max:2048',
            'status' => 'required|in:draft,published',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul artikel wajib diisi.',
            'konten.required' => 'Konten artikel tidak boleh kosong.',
            'gambar_utama.image' => 'File harus berupa gambar.',
            'gambar_utama.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ];
    }
}
