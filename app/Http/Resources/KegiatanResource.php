<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
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
            'tahun' => $this->tahun,
            'judul_kegiatan' => $this->judul_kegiatan,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan->toDateString(),
            'materi' => $this->materi,
            'tempat' => $this->tempat,
            'kapel_pj' => $this->kapel_pj,
            'sifat' => $this->sifat,
            'gambar_utama' => $this->gambar_utama ? asset($this->gambar_utama) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
