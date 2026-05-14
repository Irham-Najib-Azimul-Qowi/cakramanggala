<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanAlat extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kegiatan_alat';

    protected $fillable = [
        'kegiatan_id',
        'alat_id',
        'qty',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
