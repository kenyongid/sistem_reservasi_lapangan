<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'kode_reservasi',
        'user_id',
        'nama',
        'email',
        'telepon',
        'catatan',
        'lapangan_id',
        'slot_id',
        'tanggal',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function lapangan()
    {
        return $this->belongsTo(
            Lapangan::class,
            'lapangan_id'
        );
    }

    public function slotWaktu()
    {
        return $this->belongsTo(
            SlotWaktu::class,
            'slot_id'
        );
    }
    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class);
    }
}