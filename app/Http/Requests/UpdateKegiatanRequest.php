<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => 'required|integer|min:2000|max:2099',
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'materi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'kapel_pj' => 'required|string|max:255',
            'sifat' => 'required|in:internal,eksternal',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'dokumentasi' => 'nullable|array|max:6',
            'dokumentasi.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
