<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Dashboard - GYM-IN</title>

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
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.15);
        }

        .reward-card {
            transition: all 0.3s ease;
        }

        .reward-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.15);
        }

        .btn-tukar {
            transition: all 0.3s ease;
        }

        .btn-tukar:hover {
            transform: scale(1.05);
            background-color: rgba(77, 145, 132, 0.8);
        }

        /* Custom range slider for gym density */
        .density-slider {
            position: relative;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #10b981 0%, #f59e0b 50%, #ef4444 100%);
            border-radius: 4px;
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
        <h1 class="mt-6 text-6xl font-bold text-center text-white md:mt-12 header-glow">GYM-IN</h1>

        <!-- Welcome Section with Avatar -->
        <div class="flex items-center justify-between w-full max-w-6xl mt-8">
            <h2 class="text-2xl text-left font-bold text-white pr-5">Halo, {{ $anggota->name }}!</h2>
            <!-- Avatar Circle -->
            <div
                class="w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg flex items-center justify-center overflow-hidden border-2 border-white/20 overflow-hidden">
                {{-- <span class="text-2xl text-white">👤</span> --}}
                <img src="{{ $anggota->avatar ? asset('storage/' . $anggota->avatar) : 'https://pbs.twimg.com/media/E8YT2mbVcAIA5vv?format=jpg&name=small' }}"
                    alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Combined Streak & Rewards Box -->
        <div class="w-full max-w-6xl mt-6">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <!-- Streak Section inside box -->
                <div class="mb-6 text-center">
                    <p class="text-lg font-semibold text-white">
                        Anda telah berolahraga selama <span class="text-emerald-400">{{ $anggota->streak }}</span> hari
                        berturut-turut!
                    </p>
                    <div class="flex items-center justify-center gap-2 mt-2">
                        <span class="text-yellow-400 text-xl">🪙</span>
                        <p class="text-white">Poin Streak anda: <span class="font-bold text-emerald-400">{{
                                $anggota->points }}</span></p>
                    </div>
                </div>

                <!-- Rewards Section -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold text-gray-300">Tukar poin untuk hadiah:</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <!-- Reward 1 -->
                        <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 15v6">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Handuk Gym</p>
                                        <p class="text-sm text-emerald-400">(500 Poin)</p>
                                    </div>
                                </div>
                                <button
                                    class="btn-tukar bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition overflow-hidden">
                                    TUKAR
                                </button>
                            </div>
                        </div>

                        <!-- Reward 2 -->
                        <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Tumblr</p>
                                        <p class="text-sm text-emerald-400">(600 Poin)</p>
                                    </div>
                                </div>
                                <button
                                    class="btn-tukar bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition overflow-hidden">
                                    TUKAR
                                </button>
                            </div>
                        </div>

                        <!-- Reward 3 -->
                        <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Diskon 20%</p>
                                        <p class="text-sm text-emerald-400">(700 Poin)</p>
                                    </div>
                                </div>
                                <button
                                    class="btn-tukar bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition overflow-hidden">
                                    TUKAR
                                </button>
                            </div>
                        </div>

                        <!-- Reward 4 -->
                        <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Personal Trainer</p>
                                        <p class="text-sm text-emerald-400">(1000 Poin)</p>
                                    </div>
                                </div>
                                <button
                                    class="btn-tukar bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition overflow-hidden">
                                    TUKAR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Explore Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('member.rewards') }}" class="text-emerald-400 hover:underline text-sm">
                        Jelajahi reward lainnya →
                    </a>
                </div>
            </div>
        </div>

        <!-- Today's Summary Section -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h2 class="mb-6 text-xl font-bold text-white">Ringkasan Hari ini</h2>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <!-- Duration Card -->
                    <div class="stat-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-emerald-400">{{ $duration ? $duration->total_minutes : 0
                                }} menit</p>
                            <p class="mt-1 text-sm text-gray-300">Latihan</p>
                            <div class="flex justify-center gap-4 mt-3">
                                <span class="text-sm text-gray-400">90 kg</span>
                                <span class="text-sm text-gray-400">100 kg</span>
                            </div>
                        </div>
                    </div>

                    <!-- Calories Card -->
                    <div class="stat-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-orange-400">{{ $calory_burned ?
                                $calory_burned->total_calory : 0 }} Kkal</p>
                            <p class="mt-1 text-sm text-gray-300">Kkal</p>
                        </div>
                    </div>

                    <!-- Progress Link Card -->
                    <div
                        class="stat-card p-4 rounded-xl backdrop-blur-sm bg-white/5 flex flex-col items-center justify-center overflow-hidden">
                        <a href="{{ route('member.progres') }}" class="text-emerald-400 hover:underline text-sm">
                            Catat dan lihat perkembangan lebih lanjut →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gym Density Section with Handle/Slider -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h2 class="mb-6 text-xl font-bold text-white">Kepadatan Gym</h2>

                <div class="mb-6">
                    <div class="flex justify-between mb-3">
                        <span class="text-sm text-gray-300">Occupancy</span>
                        <span class="text-sm font-semibold text-emerald-400">35%</span>
                    </div>

                    <!-- Slider Container -->
                    <div class="relative w-full pt-5">
                        <!-- Gradient Line -->
                        <div class="density-slider"></div>

                        <!-- Handle/Knob showing 35% position -->
                        <div class="absolute w-5 h-5 bg-white rounded-full shadow-lg border-2 border-emerald-500"
                            style="left: 35%; top: 50%; transform: translate(-50%, -50%);">
                            <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                <span
                                    class="text-xs font-semibold text-white bg-black/50 px-2 py-0.5 rounded-full">35%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gradient Legend -->
                    <div class="flex justify-between mt-4 text-xs">
                        <span class="text-emerald-400">Sepi</span>
                        <span class="text-yellow-500">Normal</span>
                        <span class="text-red-500">Padat</span>
                    </div>
                </div>

                <!-- Status -->
                <div class="text-center">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <span class="text-2xl">👆</span>
                        <p class="text-base font-semibold text-emerald-400">Status: Cukup sepi</p>
                    </div>
                    <p class="text-xs text-gray-400">*Data berdasarkan <i>input</i> keluar-masuknya anggota dari kasir.
                    </p>
                </div>
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

        <!-- Bottom Navigation Bar -->
        <div
            class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-sm border-t border-white/10 max-w-md mx-auto">
            <div class="flex justify-around items-center px-4 py-3">
                <a href="{{ route('member.dashboard') }}"
                    class="flex flex-col items-center text-emerald-400 transition">
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

        <script>
            // Optional: Make the density handle interactive
        document.querySelectorAll('.density-handle').forEach(handle => {
            handle.addEventListener('click', function() {
                console.log('Density handle clicked');
            });
        });
        </script>

        <?php
    // PHP Logic for dynamic data
    /*
    $user = [
        'name' => 'Brian',
        'streak_days' => 67,
        'points' => 6700,
        'today_duration' => '18 j 21 m',
        'calories' => 300,
        'weight1' => 90,
        'weight2' => 100
    ];
    
    $rewards = [
        ['name' => 'Handuk Gym', 'points' => 500, 'icon' => 'gift'],
        ['name' => 'Tumblr', 'points' => 600, 'icon' => 'star'],
        ['name' => 'Diskon 20%', 'points' => 700, 'icon' => 'discount'],
        ['name' => 'Personal Trainer', 'points' => 1000, 'icon' => 'user']
    ];
    
    $gymDensity = [
        'percentage' => 35,
        'status' => 'Cukup sepi'
    ];
    */
    ?>

</body>

</html>