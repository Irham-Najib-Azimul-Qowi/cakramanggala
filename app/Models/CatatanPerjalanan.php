<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CatatanPerjalanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'catatan_perjalanans';

    protected $fillable = [
        'judul',
        'slug',
        'penulis',
        'angkatan',
        'tanggal_perjalanan',
        'lokasi',
        'deskripsi',
        'konten',
        'file_path',
        'gambar',
        'kegiatan_id',
        'status',
        'user_id',
        'views',
    ];

    protected $casts = [
        'tanggal_perjalanan' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Boot method untuk auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($catatan) {
            if (empty($catatan->slug)) {
                $catatan->slug = Str::slug($catatan->judul) . '-' . Str::random(5);
            }

            if (empty($catatan->deskripsi)) {
                $catatan->deskripsi = Str::limit(strip_tags($catatan->konten), 150);
            }
        });

        static::updating(function ($catatan) {
            if ($catatan->isDirty('judul') && empty($catatan->slug)) {
                $catatan->slug = Str::slug($catatan->judul) . '-' . Str::random(5);
            }

            if ($catatan->isDirty('konten') && empty($catatan->deskripsi)) {
                $catatan->deskripsi = Str::limit(strip_tags($catatan->konten), 150);
            }
        });
    }

    // Relationship dengan Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    // Relationship dengan User (pembuat catatan / admin / moderator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk catatan perjalanan yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk catatan perjalanan terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Method untuk increment views
    public function incrementViews()
    {
        $this->increment('views');
    }

    // Accessor untuk format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        return $this->tanggal_perjalanan 
            ? $this->tanggal_perjalanan->translatedFormat('d M Y') 
            : $this->created_at->translatedFormat('d M Y');
    }

    // Method untuk estimasi waktu baca
    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->konten));
        $minutes = ceil($words / 200); // 200 kata per menit
        return $minutes . ' Menit';
    }

    // Accessor untuk URL file dokumen asli
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    // Accessor untuk URL gambar utama
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('image/default-travel.jpg');
    }
}
