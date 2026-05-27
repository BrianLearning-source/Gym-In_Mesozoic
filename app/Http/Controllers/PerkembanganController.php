<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function form(Request $request)
    {
        $id = Auth::guard('member')->id();
        $selectedDateStr = $request->query('date', now()->format('Y-m-d'));
        $selectedDate = \Carbon\Carbon::parse($selectedDateStr);

        $perkembangan = PerkembanganModel::where('anggota_id', $id)
            ->whereDate('date', $selectedDate->format('Y-m-d'))
            ->first();

        if (!$perkembangan) {
            $perkembangan = new PerkembanganModel();
            $perkembangan->date = $selectedDate;
        }

        return view('progressform', [
            'perkembangan' => $perkembangan,
            'selectedDate' => $selectedDate,
        ]);
    }

    public function save(Request $request)
    {
        $id = Auth::guard('member')->id();

        $validated = $request->validate([
            'date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'calory_burned' => 'nullable|numeric|min:0',
            'diary' => 'nullable|string|max:2000',
        ]);

        $selectedDate = \Carbon\Carbon::parse($validated['date']);

        $perkembangan = PerkembanganModel::updateOrCreate(
            [
                'anggota_id' => $id,
                'date' => $selectedDate->format('Y-m-d'),
            ],
            [
                'weight' => $validated['weight'],
                'height' => $validated['height'],
                'calory_burned' => $validated['calory_burned'],
                'diary' => $validated['diary'],
            ]
        );

        return redirect()->route('member.progres', ['date' => $selectedDate->format('Y-m-d')])
            ->with('success', 'Data perkembangan berhasil disimpan.');
    }
}
