<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\PerkembanganModel;
use App\Models\Rewards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    //
    public function index()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        return view('memberdashboard', ['anggota' => $anggota]);
    }

    public function profile()
    {
        $anggota = Auth::guard('member')->user(); // Ambil data anggota yang sedang login
        return view('memberprofile', ['anggota' => $anggota]);
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
        $id = Auth::guard('member')->id(); // Ambil ID anggota yang sedang login
        $perkembangan = PerkembanganModel::find($id);
        $duration = PerkembanganModel::where('anggota_id', $id)
            ->selectRaw('TIMESTAMPDIFF(HOUR, start_time, end_time) AS duration')
            ->first();
        return view('progrestracker', ['perkembangan' => $perkembangan, 'duration' => $duration]);
    }

}
