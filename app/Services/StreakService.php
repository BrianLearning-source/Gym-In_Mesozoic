<?php

namespace App\Services;

use App\Models\AnggotaModel;
use App\Models\Presensi;

class StreakService
{
    public function updateStreak(AnggotaModel $anggota): void
    {
        $today = now()->startOfDay();

        $lastPresensi = Presensi::where('anggota_id', $anggota->id)
            ->whereDate('created_at', '<', $today)
            ->latest('created_at')
            ->first();

        if (!$lastPresensi) {
            $anggota->streak = 1;
            $anggota->points += 10;
        } else {
            
            $lastDate = $lastPresensi->created_at->startOfDay();
            $gap = $lastDate->diffInDays($today);

            $todayPresenceCount = Presensi::where('anggota_id', $anggota->id)
                ->whereDate('created_at', $today)
                ->count();

            if ($gap <= 1 + $anggota->rest_days && $todayPresenceCount <= 1) {
                $anggota->streak += 1;
                $anggota->points += 10;
            } else {
                $anggota->streak = 1;
            }
        }

        if ($anggota->streak > $anggota->highest_streak) {
            $anggota->highest_streak = $anggota->streak;
        }

        $anggota->save();
    }
}
