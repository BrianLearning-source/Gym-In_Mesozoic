<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model
{
    protected $fillable = [
        'anggota_id',
        'reward_id',
        'points_used',
        'kode_penukaran',
        'status',
        'claimed_at',
    ];

    protected function casts(): array
    {
        return [
            'claimed_at' => 'datetime',
        ];
    }

    public function anggota()
    {
        return $this->belongsTo(AnggotaModel::class, 'anggota_id', 'id');
    }

    public function reward()
    {
        return $this->belongsTo(Rewards::class, 'reward_id', 'reward_id');
    }
}
