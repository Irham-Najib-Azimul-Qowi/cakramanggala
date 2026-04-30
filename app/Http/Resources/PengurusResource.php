<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengurusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'jabatan' => $this->jabatan,
            'prodi_semester' => $this->prodi_semester,
            'instagram_url' => $this->instagram_url,
            'foto_url' => $this->foto ? asset($this->foto) : null,
            'urutan' => $this->urutan,
            'status' => $this->status,
        ];
    }
}
