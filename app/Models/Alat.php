<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'alat';

    protected $fillable = [
        'name',
        'category',
        'total_qty',
        'available_qty',
        'condition',
    ];

    public function kegiatans()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_alat', 'alat_id', 'kegiatan_id')
                    ->withPivot('qty')
                    ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(InventoryImage::class, 'entity_id')->where('entity_type', 'alat');
    }
}
