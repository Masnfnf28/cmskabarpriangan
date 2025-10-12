<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Konten extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'caption',
        'tanggal',
        'gambar',
    ];
    public function getGambarUrlAttribute()
    {
        // Method ini akan membuat URL lengkap ke file gambar
        // dan akan tersedia sebagai $konten->gambar_url
        return $this->gambar ? Storage::url($this->gambar) : null;
    }

    protected $table = 'konten';
}
