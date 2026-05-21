<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AnggotaModel extends Authenticatable
{
    //
    use HasFactory;

    protected $table = 'm_anggota';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'phone_number',
        'join_date',
        'points',
        'streak',
        'highest_streak',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'join_date' => 'date',
        'password' => 'hashed',
    ];
}
