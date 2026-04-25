<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    //
    // Yang ID nanti diambil dari session login, sementara di hardcode dulu
    public function index($id = 1)
    {
        $anggota = AnggotaModel::find($id); // Ganti dengan ID anggota yang ingin ditampilkan
        return view('memberdashboard', ['anggota' => $anggota]);
    }

    public function profile($id = 1)
    {
        $anggota = AnggotaModel::find($id); // Ganti dengan ID anggota yang ingin ditampilkan
        return view('memberprofile', ['anggota' => $anggota]);
    }

}
