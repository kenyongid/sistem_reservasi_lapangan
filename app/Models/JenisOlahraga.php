<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lapangan;

class JenisOlahraga extends Model
{
    use HasFactory;

    protected $table = 'jenis_olahraga';

    protected $fillable = [
        'nama',
    ];

    public function lapangan()
    {
        return $this->hasMany(
            Lapangan::class,
            'jenis_olahraga_id'
        );
    }
}