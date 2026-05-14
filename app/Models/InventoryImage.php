<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryImage extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'images';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'image_url',
    ];
}
