<?php

namespace App\Http\Controllers;

use App\Models\Penukaran;
use App\Models\Rewards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenukaranController extends Controller
{
    public function store(Request $request)
    {
        $anggota = Auth::guard('member')->user();

        if (!$anggota) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $request->validate([
            'reward_ids'   => 'required|array|min:1',
            'reward_ids.*' => 'exists:m_rewards,reward_id',
        ]);

        $rewards = Rewards::whereIn('reward_id', $request->reward_ids)->get();

        if ($rewards->count() !== count($request->reward_ids)) {
            return response()->json(['error' => 'Hadiah tidak ditemukan.'], 422);
        }

        $totalPoints = $rewards->sum('points_required');

        foreach ($rewards as $reward) {
            if ($reward->stock < 1) {
                return response()->json([
                    'error' => "Stok {$reward->name} sudah habis."
                ], 422);
            }
        }

        if ($anggota->points < $totalPoints) {
            return response()->json([
                'error' => "Poin tidak mencukupi. Butuh {$totalPoints}, tersisa {$anggota->points}."
            ], 422);
        }

        $lastClaimed = Penukaran::where('anggota_id', $anggota->id)
            ->where('status', 'claimed')
            ->latest('claimed_at')
            ->first();

        if ($lastClaimed && $lastClaimed->claimed_at && $lastClaimed->claimed_at->diffInDays(now()) < 28) {
            $sisa = 28 - (int) $lastClaimed->claimed_at->diffInDays(now());
            return response()->json([
                'error' => "Anda sudah menukarkan hadiah. Tunggu {$sisa} hari lagi untuk menukar kembali."
            ], 422);
        }

        $kodePenukaran = $this->generateKodePenukaran();

        DB::transaction(function () use ($anggota, $rewards, $totalPoints, $kodePenukaran) {
            foreach ($rewards as $reward) {
                Penukaran::create([
                    'anggota_id'     => $anggota->id,
                    'reward_id'      => $reward->reward_id,
                    'points_used'    => $reward->points_required,
                    'kode_penukaran' => $kodePenukaran,
                    'status'         => 'pending',
                ]);
            }

            $anggota->decrement('points', $totalPoints);
        });

        return response()->json([
            'kode_penukaran' => $kodePenukaran,
            'rewards'        => $rewards->pluck('name'),
            'total_points'   => $totalPoints,
        ]);
    }

    private function generateKodePenukaran(): string
    {
        do {
            $kode = 'TKN' . Str::upper(Str::random(6));
        } while (Penukaran::where('kode_penukaran', $kode)->exists());

        return $kode;
    }
}
