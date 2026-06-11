<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLogin() 
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('memberlogin');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan kredensial yang diberikan
        if (Auth::guard('member')->attempt($credentials)) {
            $request->session()->regenerate();


            return redirect()->intended(route('member.dashboard'));
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Ganti logout jadi Auth::logout(); pas udah selesai (cuma biar ndak ke log out habis login di admin)
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
