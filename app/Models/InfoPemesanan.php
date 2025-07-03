<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPemesanan extends Model
{
    protected $fillable = [
        'info_pengiriman',
        'info_pembayaran',
        'info_pembatalan',
        'info_harga',
    ];
}
