<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * 
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'tipe',
        'file',
        "status",
    ];
}