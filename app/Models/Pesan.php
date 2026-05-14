<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'is_read'
    ];
}
