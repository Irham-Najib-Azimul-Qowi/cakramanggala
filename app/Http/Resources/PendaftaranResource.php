<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
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
            'nama_lengkap' => $this->nama_lengkap,
            'nim' => $this->nim,
            'jurusan' => $this->jurusan,
            'program_studi' => $this->program_studi,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir->toDateString(),
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'organisasi' => $this->organisasi_yang_pernah_diikuti,
            'alasan' => $this->alasan_bergabung,
            'foto_url' => $this->foto_url,
            'status' => $this->status,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at,
        ];
    }
}
