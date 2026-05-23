<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $table = 'registrasis';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'name',
        'email',
        'phone_number',
        'password',
        'rest_days',
        'qr_code',
        'join_date',
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
