<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\Penukaran;
use App\Models\Presensi;
use App\Models\PerkembanganModel;
use App\Models\Rewards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

        $rewards = Rewards::orderBy('reward_id')->limit(4)->get();

            if ($rewards->isEmpty()) {
                return view('memberdashboard', ['rewards' => collect()]);
        }

        $kapasitas = 30;
        $nowTime = now()->format('H:i:s');
        $memberActive = Presensi::whereDate('created_at', today())
            ->whereTime('start_time', '<=', $nowTime)
            ->whereTime('end_time', '>', $nowTime)
            ->count();

        $occupancyPercent = min(round(($memberActive / $kapasitas) * 100), 100);

        if ($occupancyPercent < 30) {
            $occupancyStatus = 'Sepi';
            $occupancyColor = 'text-emerald-400';
            $handleColor = '#10b981';
        } elseif ($occupancyPercent < 66) {
            $occupancyStatus = 'Normal';
            $occupancyColor = 'text-yellow-400';
            $handleColor = '#eab308';
        } else {
            $occupancyStatus = 'Padat';
            $occupancyColor = 'text-red-400';
            $handleColor = '#ef4444';
        }

        return view('memberdashboard', [
            'anggota' => $anggota,
            'duration' => $duration,
            'rewards' => $rewards,
            'calory_burned' => $calory_burned,
            'kapasitas'        => $kapasitas,
            'memberActive'     => $memberActive,
            'occupancyPercent' => $occupancyPercent,
            'occupancyStatus' => $occupancyStatus,
            'occupancyColor' => $occupancyColor,
            'handleColor' => $handleColor,
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

    public function editProfile()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        return view('editprofile', ['anggota' => $anggota]);
    }

    public function updateProfile(Request $request)
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login

        if (!$anggota) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'email' => 'required|email|unique:m_anggota,email,' . $anggota->id,
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|in:0,1',
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $anggota->name = $request->name;
        $anggota->title = $request->title;
        $anggota->email = $request->email;
        $anggota->phone_number = $request->phone_number;
        if ($request->filled('gender')) {
            $anggota->gender = $request->gender;
        }

        if ($request->filled('password')) {
            $anggota->password = $request->password;
        }

        $oldAvatar = $anggota->avatar;

        // Avatar Upload taruh di public storage, jadi di DB cuma pathnya aja.
        if ($request->hasFile('avatar')) {
            $anggota->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $anggota->save();

        // Delete old avatar upon upload
        if ($request->hasFile('avatar') && $oldAvatar) {
            if (Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }
        return redirect()->route('member.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function rewards()
    {
        $anggota = Auth::guard('member')->user();

        $rewards = Rewards::where('stock', '>', 0)->get();

        $lastClaimed = Penukaran::where('anggota_id', $anggota->id)
            ->where('status', 'claimed')
            ->latest('claimed_at')
            ->first();

        $hariTersisa = 0;
        $bisaTukar = true;

        if ($lastClaimed && $lastClaimed->claimed_at) {
            $tanggalKlaim = \Carbon\Carbon::parse($lastClaimed->claimed_at);

            $hariTerlewat = (int) $tanggalKlaim->diffInDays(now());
            $hariTersisa = max(0, 28 - $hariTerlewat);
            $bisaTukar = $hariTersisa === 0;
        }

        return view('rewards', [
            'anggota'     => $anggota,
            'rewards'     => $rewards,
            'bisaTukar'   => $bisaTukar,
            'hariTersisa' => $hariTersisa,
        ]);
    }

    public function perkembangan(Request $request)
    {
        $id = Auth::guard('member')->id();
        $today = now();

        $selectedDateStr = $request->query('date', $today->format('Y-m-d'));
        $selectedDate = \Carbon\Carbon::parse($selectedDateStr);

        $perkembangan = PerkembanganModel::where('anggota_id', $id)
            ->whereDate('date', $selectedDate->format('Y-m-d'))
            ->first();

        if (!$perkembangan) {
            $perkembangan = new PerkembanganModel();
            $perkembangan->date = $selectedDate;
        }

        $duration = PerkembanganModel::where('anggota_id', $id)
            ->whereDate('date', $selectedDate->format('Y-m-d'))
            ->selectRaw('TIMESTAMPDIFF(MINUTE, start_time, end_time) AS total_minutes')
            ->first();

        $startOfWeek = $selectedDate->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endOfWeek = $selectedDate->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

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
                'isSelected' => $date->format('Y-m-d') === $selectedDate->format('Y-m-d'),
                'dateUrl' => $date->format('Y-m-d'),
                'duration' => $dur,
                'calory_burned' => $record?->calory_burned,
                'weight' => $record?->weight,
            ];
        }

        $chartLabels = collect($weekDays)->pluck('hari_singkat')->toArray();
        $chartWeights = collect($weekDays)->pluck('weight')->map(fn($w) => $w ?? 0)->toArray();

        return view('progrestracker', [
            'perkembangan' => $perkembangan,
            'duration' => $duration,
            'weekDays' => $weekDays,
            'chartLabels' => $chartLabels,
            'chartWeights' => $chartWeights,
        ]);
    }

    public function editPreference()
    {
        $anggota = Auth::guard('member')->user(); // Get logged in member
        return view('editpreference', ['anggota' => $anggota]);
    }

    public function updatePreference(Request $request)
    {
        $anggota = Auth::guard('member')->user();

        if (!$anggota) {
            return redirect()->route('login');
        }

        $request->validate([
            'rest_day' => 'nullable|integer|min:0|max:5',
        ]);

        $anggota->rest_days = $request->rest_day;
        $anggota->save();

        return redirect()->route('member.profile')->with('success', 'Preferensi latihan berhasil diperbarui.');
    }
}
