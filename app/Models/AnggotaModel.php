<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaModel extends Model
{
    //
    use HasFactory;

    protected $table = 'm_anggota';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'gender',
        'email',
        'phone_number',
        'join_date',
        'points',
        'streak',
        'highest_streak',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];
}
