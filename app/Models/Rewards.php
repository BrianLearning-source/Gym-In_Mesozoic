<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $table = 'm_rewards';
    protected $primaryKey = 'reward_id';

    protected $fillable = [
        'name',
        'points_required',
        'stock',
        'image',
    ];
}
