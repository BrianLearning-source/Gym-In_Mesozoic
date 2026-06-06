<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profil - GYM-IN</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .header-glow {
            text-shadow: 0px 5px 10px rgba(255, 255, 255, 0.4);
        }

        .bg-image {
            position: absolute;
            inset: 0;
            background-image: url("https://images.pexels.com/photos/4162449/pexels-photo-4162449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
            background-size: cover;
            background-position: center;
            opacity: 0.25;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-black md:mx-11">

    <!-- Background Image -->
    <div class="fixed inset-0 pointer-events-none" style="z-index: -2;">
        <div class="bg-image"></div>
    </div>

    <!-- Main Container -->
    <div class="flex flex-col items-center justify-center px-4 py-8 md:px-10">

        <!-- Title -->
        <div class="flex justify-center mt-12">
            <img src="{{ asset('img/GymInLogo.png') }}" 
                alt="Gym-In Logo" 
                class="h-20 md:h-28 w-auto header-glow"
                style="max-height: 112px;">
        </div>

        <!-- Back Button -->
        <div class="w-full max-w-6xl mt-8">
            <a href="{{ route('member.profile') }}"
                class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>

        <!-- Edit Profile Form -->
        <div class="w-full max-w-6xl mt-6 overflow-hidden">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h2 class="text-2xl font-semibold text-white mb-4">Edit Profil</h2>
                <form action="{{ route('member.updateProfile') }}" enctype="multipart/form-data" method="POST"
                    class="space-y-4" id="editProfileForm">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Upload -->
                    <div class="flex flex-row items-left gap-4">
                        <img id="avatarPreview"
                            src="{{ $anggota->avatar ? asset('storage/' . $anggota->avatar) : 'https://pbs.twimg.com/media/E8YT2mbVcAIA5vv?format=jpg&name=small' }}"
                            alt="Avatar" class="w-24 h-24 rounded-full object-cover border-2 border-white/10">

                        {{-- <label for="avatar" class="block text-sm font-medium text-white my-2">Foto Profil</label> --}}
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            onchange="previewImage(this, 'avatarPreview')"
                            class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100">
                    </div>
                    @error('avatar')
                        <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                    @enderror

                    <!-- Form Fields -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white my-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ $anggota->name }}"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('name')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="title" class="block text-sm font-medium text-white my-2">Julukan</label>
                        <input type="text" name="title" id="title" value="{{ $anggota->title }}"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('title')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white my-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ $anggota->email }}"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('email')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white my-2">Nomor Telepon</label>
                        <input type="tel" name="phone_number" id="phone" value="{{ $anggota->phone_number ?? '' }}"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="contoh: +62 812-3456-7890">
                        @error('phone_number')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-white my-2">Jenis Kelamin</label>
                        <select name="gender" id="gender"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1" @selected(($anggota->gender ?? null) == 1)>Laki-laki</option>
                            <option value="0" @selected(($anggota->gender ?? null) == 0)>Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white my-2">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti kata sandi.</p>
                        @error('password')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-white my-2">Konfirmasi
                            Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('password_confirmation')
                            <p class="text-sm text-red-400 my-2">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>

            <!-- Tombol save dipisah kalo sewaktu-waktu ada card lagi selain yang diatas -->
            <div class="mt-4 flex justify-end">
                <button form="editProfileForm" type="submit"
                    class="px-6 py-2 text-white font-semibold rounded-lg transition duration-300"
                    style="background-color: rgba(77, 145, 132);">
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="w-full max-w-6xl py-8 mt-4 mb-8 text-center">
            <p class="text-white drop-shadow-2xl">
                Mengalami kendala? Kontak kami di:
            </p>
            <p class="text-emerald-400 hover:underline text-1xl drop-shadow-2xl mt-2">
                +62 767-6767-6767
            </p>
        </div>

    </div>

    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-sm border-t border-white/10 mx-auto">
        <div class="flex justify-around items-center px-4 py-3">
            <a href="{{ route('member.dashboard') }}"
                class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="{{ route('member.progres') }}"
                class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="text-xs mt-1">Perkembangan</span>
            </a>
            <a href="{{ route('member.rewards') }}"
                class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <span class="text-xs mt-1">Rewards</span>
            </a>
            <a href="{{ route('member.profile') }}" class="flex flex-col items-center text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs mt-1">Profile</span>
            </a>
        </div>
    </div>
</body>

<script>
    function previewImage(input, previewId) {
        const [file] = input.files;
        
        if (file) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = URL.createObjectURL(file);
            }
        }
    }
</script>

</html>