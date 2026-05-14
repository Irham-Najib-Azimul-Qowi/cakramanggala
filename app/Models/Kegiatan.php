<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kegiatans';

    protected $fillable = [
        'tahun',
        'judul_kegiatan',
        'tanggal_pelaksanaan',
        'materi',
        'deskripsi',
        'tempat',
        'kapel_pj',
        'sifat',
        'user_id',
        'gambar_utama',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'dokumentasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('tahun', $year);
    }

    public function scopeBySifat($query, $sifat)
    {
        return $query->where('sifat', $sifat);
    }
}
