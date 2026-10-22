<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    protected $table = 'detail_reservasi';

    protected $fillable = [
        'reservasi_id',
        'produk_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}