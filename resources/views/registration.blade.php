<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar - Gym-In</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .fade-in-delay-1 { animation-delay: 0.1s; }
        .fade-in-delay-2 { animation-delay: 0.2s; }
        .fade-in-delay-3 { animation-delay: 0.3s; }
        .fade-in-delay-4 { animation-delay: 0.4s; }
        .fade-in-delay-5 { animation-delay: 0.5s; }
        .fade-in-delay-6 { animation-delay: 0.6s; }

        .form-group {
            opacity: 0;
        }

        .notification {
            animation: slideIn 0.4s ease-out;
        }

        .notification.fade-out {
            animation: slideOut 0.4s ease-out forwards;
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
    <div class="sticky top-0 bg-black bg-opacity-80 backdrop-blur-md w-full z-50 transition-all duration-300">
        <div class="flex items-center justify-between h-14 px-6 md:mx-11">
            <a href="/">
                <h1 class="text-2xl font-bold text-white hover:text-gray-300 transition">Gym-In</h1>
            </a>
            <a href="/loginMember/">
                <div class="bg-white w-8 h-8 rounded-full hover:scale-110 transition-transform duration-300"></div>
            </a>
        </div>
    </div>

    <!-- Notification Container -->
    @if ($errors->any())
        <div id="errorNotification" class="notification fixed top-5 right-5 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold px-6 py-4 rounded-xl shadow-2xl z-50" style="opacity: 0;">
            <div class="text-lg mb-2">⚠️ Validasi Gagal</div>
            <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div id="successNotification" class="notification fixed top-5 right-5 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold px-6 py-4 rounded-xl shadow-2xl z-50" style="opacity: 0;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            <!-- Title Section -->
            <div class="text-center mb-12 fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">
                    Bergabunglah dengan <span class="bg-gradient-to-r from-purple-400 to-pink-600 bg-clip-text text-transparent"><i>Gym</i>-In</span>
                </h1>
                <p class="text-gray-300 text-lg">Mulai perjalananmu menuju tubuh impian hari ini</p>
            </div>

            <!-- Form Card -->
            <form action="/register" method="POST" class="bg-white bg-opacity-5 backdrop-blur-xl border border-white border-opacity-10 rounded-3xl p-8 md:p-12 space-y-6" id="registrationForm">
                @csrf

                <!-- Row 1: Username & Name -->
                <div class="form-group fade-in fade-in-delay-1">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}"
                                required minlength="3" maxlength="50"
                                pattern="^[a-zA-Z0-9_-]+$" title="Username hanya boleh berisi huruf, angka, underscore, dan dash"
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

                <!-- Row 3: Height & Weight -->
                <div class="form-group fade-in fade-in-delay-3">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">
                                Tinggi Badan (cm) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="height" placeholder="Contoh: 170"
                                required min="50" max="300" step="0.1" value="{{ old('height') }}"
                                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                            <p class="text-gray-400 text-xs mt-2">Rentang: 50-300 cm</p>
                            @error('height')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-white text-sm font-semibold mb-2">
                                Berat Badan (kg) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="weight" placeholder="Contoh: 70"
                                required min="20" max="500" step="0.1" value="{{ old('weight') }}"
                                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                            <p class="text-gray-400 text-xs mt-2">Rentang: 20-500 kg</p>
                            @error('weight')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Row 4: Rest Days -->
                <div class="form-group fade-in fade-in-delay-4">
                    <label class="block text-white text-sm font-semibold mb-2">
                        Hari Istirahat (0-5) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="rest_days" placeholder="Contoh: 2"
                        required min="0" max="5" value="{{ old('rest_days') }}"
                        class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-white placeholder-opacity-60 focus:bg-opacity-15 focus:border-opacity-40 focus:outline-none transition-all duration-300">
                    <p class="text-gray-400 text-xs mt-2">Bantuan saat Anda melewatkan latihan tanpa kehilangan streak</p>
                    @error('rest_days')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group fade-in fade-in-delay-5 pt-6">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold uppercase py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl"
                        id="submitBtn">
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Login Link -->
                <p class="text-center text-gray-400 text-sm">
                    Sudah punya akun?
                    <a href="/loginMember" class="text-purple-400 hover:text-purple-300 font-semibold transition">Login di sini</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Animate form groups on page load
        window.addEventListener('load', () => {
            document.querySelectorAll('.form-group').forEach(group => {
                group.style.opacity = '1';
            });

            // Show notifications
            const successNotif = document.getElementById('successNotification');
            const errorNotif = document.getElementById('errorNotification');

            if (successNotif) {
                successNotif.style.opacity = '1';
                setTimeout(() => {
                    successNotif.classList.add('fade-out');
                }, 3000);
            }

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
