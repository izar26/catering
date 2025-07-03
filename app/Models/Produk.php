<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['kategori_id', 'nama', 'slug', 'tipe', 'deskripsi', 'harga', 'gambar', 'pesan_wa', 'is_unggulan',];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

