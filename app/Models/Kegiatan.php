<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'judul_kegiatan',
        'tanggal_pelaksanaan',
        'materi',
        'tempat',
        'kapel_pj',
        'sifat',
        'user_id'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'tahun' => 'integer'
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter berdasarkan tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun', $year);
    }

    /**
     * Scope untuk filter berdasarkan sifat
     */
    public function scopeBySifat($query, $sifat)
    {
        return $query->where('sifat', $sifat);
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getFormattedDateAttribute()
    {
        return $this->tanggal_pelaksanaan->format('d/m/Y');
    }

    /**
     * Accessor untuk status kegiatan (sudah lewat atau belum)
     */
    public function getStatusAttribute()
    {
        return $this->tanggal_pelaksanaan->isPast() ? 'selesai' : 'akan_datang';
    }
}