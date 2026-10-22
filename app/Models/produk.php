<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'gambar',
        'status',
    ];

    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class);
    }
}