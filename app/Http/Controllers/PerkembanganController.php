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
        $perkembangan = PerkembanganModel::find($id);
        $duration = PerkembanganModel::where('anggota_id', $id)
            ->selectRaw('TIMESTAMPDIFF(HOUR, start_time, end_time) AS duration')
            ->first();
        return view('progrestracker', ['perkembangan' => $perkembangan, 'duration' => $duration]);
    }
}
