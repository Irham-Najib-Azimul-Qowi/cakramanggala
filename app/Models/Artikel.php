<?php
// File: app/Models/Artikel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'konten',
        'gambar_utama',
        'status',
        'user_id',
        'views'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Boot method untuk auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
            
            // Generate excerpt jika kosong
            if (empty($artikel->excerpt)) {
                $artikel->excerpt = Str::limit(strip_tags($artikel->konten), 150);
            }
        });
        
        static::updating(function ($artikel) {
            if ($artikel->isDirty('judul') && empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
            
            if ($artikel->isDirty('konten') && empty($artikel->excerpt)) {
                $artikel->excerpt = Str::limit(strip_tags($artikel->konten), 150);
            }
        });
    }

    // Relationship dengan User (penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk artikel yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk artikel terbaru
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
        return $this->created_at->format('d M Y');
    }

    // Accessor untuk URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar_utama) {
            return asset('storage/' . $this->gambar_utama);
        }
        return asset('image/default-article.jpg'); // Gambar default
    }
}