<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function showRegistration()
    {
        return view('registration');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|min:3|max:50|unique:m_anggota,username|regex:/^[a-zA-Z0-9_-]+$/',
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:100|unique:m_anggota,email',
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:20|max:500',
            'rest_days' => 'required|integer|min:0|max:5',
        ]);

        try {
            // Generate temporary password
            $tempPassword = '1234';

            // Generate unique QR code
            $qrCode = $this->generateQRCode();

            $anggota = new AnggotaModel();
            $anggota->username = $validated['username'];
            $anggota->name = $validated['name'];
            $anggota->email = $validated['email'];
            $anggota->height = $validated['height'];
            $anggota->weight = $validated['weight'];
            $anggota->rest_days = $validated['rest_days'];
            $anggota->qr_code = $qrCode;
            $anggota->password = bcrypt($tempPassword);
            $anggota->join_date = now();
            $anggota->points = 0;
            $anggota->streak = 0;
            $anggota->highest_streak = 0;
            $anggota->status = 'pending';
            $anggota->save();

            // Log registration
            Log::info('New registration', [
                'qr_code' => $qrCode,
                'username' => $validated['username']
            ]);

            // IMPORTANT: Use session()->flash() or redirect with session data
            return redirect()->route('register')->with([
                'success' => true,
                'qr_code' => $qrCode,
                'username' => $validated['username'],
                'email' => $validated['email'],
                'temp_password' => $tempPassword,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateQRCode(): string
    {
        do {
            $qrCode = 'GYM' . Str::upper(Str::random(8));
        } while (AnggotaModel::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }
}