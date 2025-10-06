<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'caption',
        'tanggal',
        'gambar',
        'url',
    ];

    protected $table = 'konten';
}
