<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute(): string
    {
        $image = (string) $this->image;

        if (! $image) {
            return asset('img/GymInLogo.png');
        }

        $candidates = [];

        if (str_starts_with($image, 'rewards/')) {
            $candidates[] = $image;
        } else {
            $candidates[] = 'rewards/' . $image;
        }

        if (str_starts_with($image, 'public/')) {
            $candidates[] = substr($image, strlen('public/'));
        }

        if (str_starts_with($image, 'storage/')) {
            $candidates[] = substr($image, strlen('storage/'));
        }

        foreach ($candidates as $path) {
            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->url($path);
            }
        }

        if (file_exists(public_path($image))) {
            return asset($image);
        }

        return asset('img/GymInLogo.png');
    }
}
