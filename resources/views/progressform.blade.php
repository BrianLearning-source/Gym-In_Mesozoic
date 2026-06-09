<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catat Perkembangan - GYM-IN</title>

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
    </style>
</head>

<body class="bg-black md:mx-11">

    <div class="fixed inset-0 pointer-events-none" style="z-index: -2;">
        <div class="bg-image"></div>
    </div>

    <div class="flex flex-col items-center justify-center px-4 py-8 md:px-10">

        <!-- Title -->
        <div class="flex justify-center mt-12">
            <img src="{{ asset('img/GymInLogo.png') }}" 
                alt="Gym-In Logo" 
                class="h-20 md:h-28 w-auto header-glow"
                style="max-height: 112px;">
        </div>

        
        <div class="w-full max-w-6xl mt-8">
            <a href="{{ route('member.progres', ['date' => $selectedDate->format('Y-m-d')]) }}"
                class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>

        <div class="w-full max-w-6xl mt-6 overflow-hidden">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">{{ $perkembangan->exists ? 'Edit Perkembangan' : 'Tambah Perkembangan' }}</h2>
                        <p class="text-sm text-gray-400 mt-1">Data untuk tanggal {{ $selectedDate->locale('id')->translatedFormat('l, j F Y') }}.</p>
                    </div>
                    <span class="flex items-center justify-center text-center rounded-2xl bg-emerald-500/20 px-3 py-1 text-sm text-emerald-200">
                        {{ $perkembangan->exists ? 'Mode Sunting' : 'Mode Tambah' }}
                    </span>
                </div>

                @if ($errors->any())
                    <div class="mb-4 rounded-2xl border border-red-400/50 bg-red-500/10 p-4 text-sm text-red-100">
                        <p class="font-semibold">Perbaiki kesalahan berikut:</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (!$presensiExists && !$perkembangan->exists)
                    <div class="rounded-2xl border border-white/10 bg-white/10 p-6 text-center">
                        <p class="text-lg font-semibold text-white">Presensi belum tercatat</p>
                        <p class="mt-2 text-sm text-gray-300">Presensi Anda belum tercatat. Silahkan ke kasir untuk mencatat presensi.</p>
                    </div>
                @else
                    <form action="{{ route('member.progressSave') }}" method="POST" class="space-y-5" id="progressForm">
                        @csrf

                        <input type="hidden" name="date" value="{{ $selectedDate->format('Y-m-d') }}">

                        <div>
                            <label for="weight" class="block text-sm font-medium text-white mb-2">Berat Badan (kg)</label>
                            <input type="number" name="weight" id="weight" step="0.1" min="0"
                                value="{{ old('weight', $perkembangan->weight) }}"
                                class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label for="height" class="block text-sm font-medium text-white mb-2">Tinggi Badan (cm)</label>
                            <input type="number" name="height" id="height" step="1" min="0"
                                value="{{ old('height', $perkembangan->height) }}"
                                class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label for="calory_burned" class="block text-sm font-medium text-white mb-2">Kalori Terbakar (kkal)</label>
                            <input type="number" name="calory_burned" id="calory_burned" step="1" min="0"
                                value="{{ old('calory_burned', $perkembangan->calory_burned) }}"
                                class="w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label for="diary" class="block text-sm font-medium text-white mb-2">Catatan / Diary</label>
                            <textarea name="diary" id="diary" rows="6"
                                class="w-full resize-none rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                placeholder="Tulis catatan latihan hari ini...">{{ old('diary', $perkembangan->diary) }}</textarea>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 text-white font-semibold rounded-lg transition duration-300"
                                style="background-color: rgba(77, 145, 132);">
                                Simpan Perkembangan
                            </button>
                        </div>
                    </form>
                @endif
        </div>

        <div class="w-full max-w-6xl py-8 mt-4 mb-8 text-center">
            <p class="text-white drop-shadow-2xl">Butuh bantuan? Kontak kami di:</p>
            <p class="text-emerald-400 hover:underline text-1xl drop-shadow-2xl mt-2">+62 767-6767-6767</p>
        </div>
    </div>

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
                class="flex flex-col items-center text-emerald-400 transition">
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
                <span class="text-xs mt-1">Bonus</span>
            </a>
            <a href="{{ route('member.profile') }}"
                class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </div>

</body>

</html>