<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 50 karakter',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, underscore, dan dash',
            'name.required' => 'Nama lengkap harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 50 cm',
            'height.max' => 'Tinggi badan maksimal 300 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 20 kg',
            'weight.max' => 'Berat badan maksimal 500 kg',
            'rest_days.required' => 'Hari istirahat harus diisi',
            'rest_days.integer' => 'Hari istirahat harus berupa angka',
            'rest_days.min' => 'Hari istirahat minimal 0',
            'rest_days.max' => 'Hari istirahat maksimal 5',
        ]);

        try {
            // Generate temporary password
            $tempPassword = Str::random(12);

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
            $anggota->save();

            // Log registration in admin panel
            $this->logAdminNotification($anggota, $tempPassword, $qrCode);

            // Return success with QR code
            return redirect('/loginMember')->with('success', 'Pendaftaran berhasil!')
                ->with('qr_code', $qrCode)
                ->with('username', $validated['username'])
                ->with('temp_password', $tempPassword);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.');
        }
    }

    private function generateQRCode(): string
    {
        do {
            $qrCode = Str::upper(Str::random(8));
        } while (AnggotaModel::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }

    private function logAdminNotification(AnggotaModel $anggota, string $tempPassword, string $qrCode)
    {
        // Log for admin dashboard
        \Log::channel('registration')->info('New member registration', [
            'member_id' => $anggota->id,
            'username' => $anggota->username,
            'name' => $anggota->name,
            'email' => $anggota->email,
            'qr_code' => $qrCode,
            'password' => $tempPassword,
            'height' => $anggota->height,
            'weight' => $anggota->weight,
            'rest_days' => $anggota->rest_days,
            'registered_at' => now(),
        ]);

        // Create admin notification if AdminNotification model exists
        if (class_exists('App\Models\AdminNotification')) {
            try {
                \App\Models\AdminNotification::create([
                    'type' => 'new_member_registration',
                    'title' => 'Pendaftaran Member Baru',
                    'message' => "{$anggota->name} ({$anggota->username}) telah mendaftar. QR Code: {$qrCode}",
                    'data' => json_encode([
                        'member_id' => $anggota->id,
                        'username' => $anggota->username,
                        'name' => $anggota->name,
                        'email' => $anggota->email,
                        'qr_code' => $qrCode,
                        'password' => $tempPassword,
                        'height' => $anggota->height,
                        'weight' => $anggota->weight,
                        'rest_days' => $anggota->rest_days,
                    ]),
                    'member_id' => $anggota->id,
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to create admin notification', ['error' => $e->getMessage()]);
            }
        }
    }
}

