<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    use HasFactory;

    protected $table = 'slot_waktu';

    protected $fillable = [
        'lapangan_id',
        'jam_mulai',
        'jam_selesai',
    ];

    public function lapangan()
    {
        return $this->belongsTo(
            Lapangan::class,
            'lapangan_id'
        );
    }

    public function reservasi()
    {
        return $this->hasMany(
            Reservasi::class,
            'slot_id'
        );
    }
}