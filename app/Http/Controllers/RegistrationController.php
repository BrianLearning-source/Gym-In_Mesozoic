<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
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
            'username' => 'required|string|min:3|max:50|unique:registrasis,username|regex:/^[a-zA-Z0-9_-]+$/',
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:100|unique:registrasis,email',
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        try {
            // Generate temporary password
            $tempPassword = '1234';

            // Generate temporarty rest days
            $tempRestDays = '3';

            // Generate unique QR code
            $qrCode = $this->generateQRCode();

            $regis = new Registrasi();
            $regis->username = $validated['username'];
            $regis->name = $validated['name'];
            $regis->email = $validated['email'];
            $regis->phone_number = $validated['phone_number'];
            $regis->rest_days = $tempRestDays;
            $regis->qr_code = $qrCode;
            $regis->password = bcrypt($tempPassword);
            $regis->join_date = now();
            $regis->save();

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
        } while (Registrasi::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }
}