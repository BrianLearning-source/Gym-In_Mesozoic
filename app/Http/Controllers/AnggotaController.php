<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\PerkembanganModel;
use App\Models\Rewards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    //
    public function index()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        $today = now();

        $duration = PerkembanganModel::where('anggota_id', $anggota->id)
            ->whereDate('date', $today->format('Y-m-d'))
            ->selectRaw('TIMESTAMPDIFF(MINUTE, start_time, end_time) AS total_minutes')
            ->first();
        $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

        $calory_burned = PerkembanganModel::where('anggota_id', $anggota->id)
            ->whereDate('date', $today->format('Y-m-d'))
            ->selectRaw('SUM(calory_burned) AS total_calory')
            ->first();


        return view('memberdashboard', [
            'anggota' => $anggota, 
            'duration' => $duration, 
            'calory_burned' => $calory_burned, 
            ]);
    }

    public function profile()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        $today = now();
        $perkembangan = PerkembanganModel::where('anggota_id', $anggota->id)
            ->latest('date')
            ->first();

        $totalDuration = PerkembanganModel::where('anggota_id', $anggota->id)->get();

        $totalMinutes = 0;

        foreach ($totalDuration as $record) {
            if ($record->start_time && $record->end_time) {
                $start = Carbon::parse($record->start_time);
                $end = Carbon::parse($record->end_time);
                $totalMinutes += $start->diffInMinutes($end);
            }
        }

        $totalTrainingTime = round($totalMinutes / 60, 1);

        $weight = $perkembangan?->weight ?? '-';
        $height = $perkembangan?->height ?? '-';
        return view('memberprofile', ['anggota' => $anggota, 'perkembangan' => $perkembangan, 'totalTrainingTime' => $totalTrainingTime, 'weight' => $weight, 'height' => $height]);
    }

    public function rewards()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        
        $rewards = Rewards::where('stock', '>', 0)->get();

        return view('rewards', [
            'anggota' => $anggota,
            'rewards' => $rewards]);
    }

    public function perkembangan()
    {
        $id = Auth::guard('member')->id();
        $today = now();

        $perkembangan = PerkembanganModel::where('anggota_id', $id)
            ->whereDate('date', $today->format('Y-m-d'))
            ->first();

        if (!$perkembangan) {
            $perkembangan = new PerkembanganModel();
            $perkembangan->date = $today;
        }

        $duration = PerkembanganModel::where('anggota_id', $id)
            ->whereDate('date', $today->format('Y-m-d'))
            ->selectRaw('TIMESTAMPDIFF(MINUTE, start_time, end_time) AS total_minutes')
            ->first();
        $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

        $weekRecords = PerkembanganModel::where('anggota_id', $id)
            ->whereBetween('date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->get()
            ->keyBy(fn($item) => $item->date->format('Y-m-d'));

        $hariSingkat = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $hariPanjang = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $weekDays = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dateStr = $date->format('Y-m-d');
            $record = $weekRecords->get($dateStr);

            $dur = null;
            if ($record && $record->start_time && $record->end_time) {
                $start = \Carbon\Carbon::parse($record->start_time);
                $end = \Carbon\Carbon::parse($record->end_time);
                $dur = $start->diffInMinutes($end);
            }

            $weekDays[] = [
                'hari_singkat' => $hariSingkat[$i],
                'hari_panjang' => $hariPanjang[$i],
                'date' => $date,
                'isToday' => $date->isToday(),
                'duration' => $dur,
                'calory_burned' => $record?->calory_burned,
                'weight' => $record?->weight,
            ];
        }

        return view('progrestracker', [
            'perkembangan' => $perkembangan,
            'duration' => $duration,
            'weekDays' => $weekDays,
        ]);
    }

}
