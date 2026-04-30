<?php
// File: app/Models/Pendaftaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    
    protected $fillable = [
        'nama_lengkap',
        'nim',
        'jurusan',
        'program_studi',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'organisasi_yang_pernah_diikuti',
        'alasan_bergabung',
        'foto_diri'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Accessor untuk mendapatkan usia
    public function getAgeAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // Accessor untuk format tanggal lahir
    public function getTanggalLahirFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->format('d F Y');
    }

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto_diri) {
            return asset('storage/' . $this->foto_diri);
        }
        return null;
    }

    // Accessor untuk initial nama
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->nama_lengkap, 0, 1));
    }

    // Scope untuk filter by jurusan
    public function scopeByJurusan($query, $jurusan)
    {
        return $query->where('jurusan', $jurusan);
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'LIKE', "%{$search}%")
              ->orWhere('nim', 'LIKE', "%{$search}%")
              ->orWhere('program_studi', 'LIKE', "%{$search}%");
        });
    }

    // Scope untuk bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }
}