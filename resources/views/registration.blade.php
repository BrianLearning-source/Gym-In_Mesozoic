<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar - Gym-In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        @keyframes modalPop {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .fade-in-delay-1 {
            animation-delay: 0.1s;
        }

        .fade-in-delay-2 {
            animation-delay: 0.2s;
        }

        .fade-in-delay-3 {
            animation-delay: 0.3s;
        }

        .fade-in-delay-4 {
            animation-delay: 0.4s;
        }

        .fade-in-delay-5 {
            animation-delay: 0.5s;
        }

        .fade-in-delay-6 {
            animation-delay: 0.6s;
        }

        .form-group {
            opacity: 0;
        }

        .notification {
            animation: slideIn 0.4s ease-out;
        }

        .notification.fade-out {
            animation: slideOut 0.4s ease-out forwards;
        }

        .modal-content {
            animation: modalPop 0.3s ease-out;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="bg-black">
    <!-- Header -->
    <div class="sticky top-0 bg-black bg-opacity-80 backdrop-blur-md w-full z-50 transition-all duration-300"
        id="header">
        <div class="flex items-center justify-between h-20 px-6 md:mx-11">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/GymInLogo.png') }}" 
                    alt="Gym-In Logo" 
                    class="h-8 md:h-10 w-auto" 
                    style="max-height: 40px;">
        </a>
        </div>
    </div>

    <!-- Notification Container -->
    @if ($errors->any())
    <div id="errorNotification"
        class="notification fixed top-5 right-5 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold px-6 py-4 rounded-xl shadow-2xl z-50"
        style="opacity: 0;">
        <div class="text-lg mb-2">⚠️ Validasi Gagal</div>
        <ul class="text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Registration Form -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            <!-- Title Section -->
            <div class="text-center mb-12 fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">
                    Bergabunglah dengan
                    <br>
                    <span
                        class="bg-gradient-to-r from-emerald-400 to-green-600 bg-clip-text text-transparent"><i>Gym</i>-In</span>
                </h1>
                <p class="text-gray-300 text-lg">Mulai perjalananmu menuju tubuh impian hari ini</p>
            </div>

            <!-- Back Button -->
            <a href="/"
                class="text-white font-semibold text-left hover:underline hover:scale-105 transform transition duration-300">
                ← Kembali
            </a>

            <!-- Form Card -->
            <form action="{{ route('register.submit') }}" method="POST"
                class="bg-white bg-opacity-5 backdrop-blur-xl border border-white border-opacity-10 rounded-3xl p-8 md:p-12 space-y-6 mt-5"
                id="registrationForm">
                @csrf

                <!-- Row 1: Username & Name -->
                <div class="form-group fade-in fade-in-delay-1">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">
                                Nama Pengguna <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="username" placeholder="Masukkan nama user"
                                value="{{ old('username') }}" required minlength="3" maxlength="50"
                                pattern="^[a-zA-Z0-9_-]+$"
                                title="Nama User hanya boleh berisi huruf, angka, underscore, dan dash"
                                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                            @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}"
                                required minlength="3" maxlength="100"
                                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Row 2: Email only -->
                <div class="form-group fade-in fade-in-delay-2">
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                            required maxlength="100"
                            class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 3: Phone Number -->
                <div class="form-group fade-in fade-in-delay-2">
                    <div>
                        <label class="block text-white text-sm font-semibold mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="phone_number" name="phone_number" placeholder="Masukkan Nomor Telepon"
                            value="{{ old('phone_number') }}" required maxlength="100"
                            class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                        @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group fade-in fade-in-delay-5 pt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r bg-emerald-500 hover:from-emerald-600 hover:to-green-500 disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold uppercase py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl"
                        id="submitBtn">
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-400 text-sm">
                    Sudah punya akun?
                    <a href="/loginMember" class="text-emerald-400 hover:text-emerald-300 font-semibold transition">Masuk
                        di sini</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Success Modal with QR Code - NO REDIRECT -->
    @if(session('success') && session('qr_code'))
    <div id="successModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50">
        <div
            class="bg-gradient-to-br from-gray-900 to-black rounded-2xl max-w-md w-full mx-4 p-6 border border-purple-500/30 modal-content">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    🎉 Pendaftaran Berhasil!
                </h3>
                <button onclick="closeModal()"
                    class="text-gray-400 hover:text-white text-3xl leading-5">&times;</button>
            </div>

            <!-- QR Code -->
            <div class="flex justify-center my-4">
                <div id="qrCodeContainer" class="bg-white p-4 rounded-xl"></div>
            </div>

            <!-- Registration Info -->
            <div class="bg-white/5 rounded-xl p-4 space-y-2">
                <p class="text-gray-300 text-sm">
                    <strong class="text-white">Nama Pengguna:</strong> {{ session('username') }}
                </p>
                <p class="text-gray-300 text-sm">
                    <strong class="text-white">Email:</strong> {{ session('email') }}
                </p>
                <p class="text-gray-300 text-sm">
                    <strong class="text-white">QR Code:</strong>
                    <code class="text-yellow-400 text-xs break-all">{{ session('qr_code') }}</code>
                </p>
                <div class="border-t border-white/10 my-2 pt-2">
                    <p class="text-yellow-400 text-xs">🔐 Password sementara: <strong>1234</strong></p>
                    <p class="text-blue-400 text-xs mt-1">⏳ Akun Anda menunggu aktivasi admin</p>
                    <p class="text-purple-400 text-xs">💪 Gunakan <i>QR code</i> untuk daftar nanti</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 space-y-2">
                <button onclick="closeModal()"
                    class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-2 rounded-lg transition">
                    Tutup
                </button>
                <button onclick="downloadQR()"
                    class="w-full bg-white/10 hover:bg-white/20 text-white font-semibold py-2 rounded-lg transition text-sm">
                    💾 Download QR Code
                </button>
            </div>
        </div>
    </div>

    <script>
        // Generate QR Code
        new QRCode(document.getElementById("qrCodeContainer"), {
            text: "{{ session('qr_code') }}",
            width: 180,
            height: 180,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        
        function closeModal() {
            // Just hide the modal, stay on the same page
            document.getElementById('successModal').style.display = 'none';
            // Optional: Clear the form so user can register another account
            document.getElementById('registrationForm').reset();
            // Remove the success flag from URL to prevent re-showing
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        
        function downloadQR() {
            const qrCanvas = document.querySelector('#qrCodeContainer canvas');
            if (qrCanvas) {
                const link = document.createElement('a');
                link.download = 'qr-code-{{ session('username') }}.png';
                link.href = qrCanvas.toDataURL();
                link.click();
            } else {
                alert('Gagal download QR code');
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
    @endif

    <script>
        // Animate form groups on page load
        window.addEventListener('load', () => {
            document.querySelectorAll('.form-group').forEach(group => {
                group.style.opacity = '1';
            });

            // Show error notification
            const errorNotif = document.getElementById('errorNotification');
            if (errorNotif) {
                errorNotif.style.opacity = '1';
                setTimeout(() => {
                    errorNotif.classList.add('fade-out');
                }, 5000);
            }
        });

        // Form validation feedback
        const form = document.getElementById('registrationForm');
        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
            input.addEventListener('invalid', (e) => {
                e.preventDefault();
                input.style.borderColor = '#ff6b6b';
            });

            input.addEventListener('input', () => {
                if (input.validity.valid) {
                    input.style.borderColor = '';
                }
            });

            input.addEventListener('change', () => {
                if (input.validity.valid) {
                    input.style.borderColor = '';
                }
            });
        });

        // Disable submit button during submission
        form.addEventListener('submit', (e) => {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mendaftar...';
        });
    </script>
</body>

</html>