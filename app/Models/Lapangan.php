<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'jenis_olahraga_id',
        'nama',
        'gambar',
        'harga_per_jam',
        'status',
    ];

    public function jenisOlahraga()
    {
        return $this->belongsTo(
            JenisOlahraga::class,
            'jenis_olahraga_id'
        );
    }

    public function slotWaktu()
    {
        return $this->hasMany(
            SlotWaktu::class,
            'lapangan_id'
        );
    }

    public function reservasi()
    {
        return $this->hasMany(
            Reservasi::class,
            'lapangan_id'
        );
    }
}