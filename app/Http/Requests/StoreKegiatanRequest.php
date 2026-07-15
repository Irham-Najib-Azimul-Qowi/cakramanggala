<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 5),
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'materi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'kapel_pj' => 'required|string|max:255',
            'sifat' => 'required|in:umum,gunung_hutan,panjat_tebing',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'dokumentasi' => 'nullable|array|max:6',
            'dokumentasi.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan harus ditentukan.',
            'gambar_utama.image' => 'File harus berupa gambar.',
        ];
    }
}
