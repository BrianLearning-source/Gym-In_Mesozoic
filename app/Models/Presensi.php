<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'anggota_id',
        'name',
        'start_time',
        'end_time',
    ];

    public function anggota()
        {
            return $this->belongsTo(AnggotaModel::class, 'anggota_id', 'id');
        }
    
}
