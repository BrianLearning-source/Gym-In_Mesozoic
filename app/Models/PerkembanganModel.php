<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerkembanganModel extends Model
{
    //
    protected $table = 'm_perkembangan';
    protected $primaryKey = 'perkembangan_id';

    protected $fillable = [
        'anggota_id',
        'date',
        'start_time',
        'end_time',
        'weight',
        'height',
        'calory_burned',
        'diary',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function anggota()
    {
        return $this->belongsTo(AnggotaModel::class, 'anggota_id', 'id');
    }
}
