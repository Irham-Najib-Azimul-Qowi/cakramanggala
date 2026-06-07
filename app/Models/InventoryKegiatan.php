<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryKegiatan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kegiatan';

    protected $fillable = [
        'id',
        'name',
        'description',
        'date',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(AppUser::class, 'created_by');
    }

    public function alats()
    {
        return $this->belongsToMany(Alat::class, 'kegiatan_alat', 'kegiatan_id', 'alat_id')
                    ->withPivot('qty')
                    ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(InventoryImage::class, 'entity_id')->where('entity_type', 'kegiatan');
    }
}
