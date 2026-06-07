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
            'reward_id' => 'required|exists:m_rewards,reward_id',
        ]);

        $reward = Rewards::findOrFail($request->reward_id);

        if ($reward->stock < 1) {
            return response()->json(['error' => 'Stok hadiah sudah habis.'], 422);
        }

        if ($anggota->points < $reward->points_required) {
            return response()->json(['error' => 'Poin tidak mencukupi.'], 422);
        }

        $lastClaimed = Penukaran::where('anggota_id', $anggota->id)
            ->where('status', 'claimed')
            ->latest('claimed_at')
            ->first();

        // FIX: Added null check for claimed_at
        if ($lastClaimed && $lastClaimed->claimed_at && $lastClaimed->claimed_at->diffInDays(now()) < 28) {
            $sisa = 28 - (int) $lastClaimed->claimed_at->diffInDays(now());
            return response()->json([
                'error' => "Anda sudah menukarkan hadiah. Tunggu {$sisa} hari lagi untuk menukar kembali."
            ], 422);
        }

        $penukaran = DB::transaction(function () use ($anggota, $reward) {
            $penukaran = Penukaran::create([
                'anggota_id'     => $anggota->id,
                'reward_id'      => $reward->reward_id,
                'points_used'    => $reward->points_required,
                'kode_penukaran' => 'GYMIN:' . (string) Str::uuid(),
                'status'         => 'pending',
            ]);

            $anggota->decrement('points', $reward->points_required);

            return $penukaran;
        });

        return response()->json([
            'kode_penukaran' => $penukaran->kode_penukaran,
            'reward'         => $reward->name,
            'points_used'    => $reward->points_required,
        ]);
    }
}
