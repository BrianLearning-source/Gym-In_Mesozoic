<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerkembanganModel;

class PerkembanganController extends Controller
{
    //
    // Yang ID nanti diambil dari session login, sementara di hardcode dulu
    public function index($id = 1)
    {
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
            ->selectRaw('TIMESTAMPDIFF(HOUR, start_time, end_time) AS duration')
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
                $dur = number_format($start->diffInMinutes($end) / 60, 1);
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
