<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengurusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'jabatan' => 'required|string|max:255',
            'prodi_semester' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ];
    }
}
