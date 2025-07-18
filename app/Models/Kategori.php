<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'slug'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}

