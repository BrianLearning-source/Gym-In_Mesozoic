<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rewards - GYM-IN</title>

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

        .reward-card {
            transition: all 0.3s ease;
        }

        .reward-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.15);
        }

        .btn-pilih {
            transition: all 0.3s ease;
        }

        .btn-pilih:hover {
            transform: scale(1.05);
            background-color: rgba(77, 145, 132, 0.8);
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

        <!-- Back Button -->
        <div class="w-full max-w-6xl mt-8">
            <a href="{{ route('member.dashboard') }}"
                class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>

        <!-- Points Display Card -->
        <div class="w-full max-w-6xl mt-6">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-gradient-to-r from-emerald-900/40 to-teal-900/40">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="md:text-left text-center">
                        <p class="text-gray-300">Poin <i>streak</i> anda</p>
                        <p class="text-3xl font-bold text-white">{{ $anggota->points }}</p>
                    </div>
                    <div class="md:text-right text-center">
                        <p class="text-gray-300">Hadiah-hadiah yang dipilih akan mengurangi</p>
                        <p class="text-2xl font-bold text-red-400">-2500 Poin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar reward yang bisa ditukar Section -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h2 class="mb-6 text-xl font-bold text-white">Daftar hadiah yang bisa ditukar</h2>

                <!-- Rewards Grid -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <!-- Item reward yang terintegrasi dengan database -->

                    @foreach($rewards as $reward)
                    <!-- Pengulangan dalam membuat item reward -->
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">

                            <div class="flex items-center gap-3">

                                <!-- Gambar -->
                                <div class="w-12 h-12 rounded-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $reward->image) }}"
                                        class="w-full h-full object-cover">
                                </div>

                                <div>
                                    <p class="font-semibold text-white">
                                        {{ $reward->name }}
                                    </p>
                                    <p class="text-sm text-emerald-400">
                                        ({{ $reward->points_required }} Poin)
                                    </p>
                                </div>
                            </div>

                            <button
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                                PILIH
                            </button>

                        </div>
                    </div>
                    @endforeach



                    <!-- {{--
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
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
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition">
                                PILIH
                            </button>
                        </div>
                    </div> --}} -->

                    
                    <!-- Reward 2
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
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
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition">
                                PILIH
                            </button>
                        </div>
                    </div>  -->

                    <!-- Reward 3 -->
                    <!-- <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Diskon 20% Membership</p>
                                    <p class="text-sm text-emerald-400">(700 Poin)</p>
                                </div>
                            </div>
                            <button
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition">
                                PILIH
                            </button>
                        </div>
                    </div>
                </div>  -->

  
                <!-- Second Row --> <!-- Reward 4 -->

                <!-- <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
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
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition">
                                PILIH
                            </button>
                        </div>
                    </div>  -->

     
                    <!-- Reward 5 --> <!--
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
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
                                class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition">
                                PILIH
                            </button>
                        </div>
                    </div> -->


                    <!-- Reward 6 with BATALKAN button --> <!--
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Diskon 20% Membership</p>
                                    <p class="text-sm text-emerald-400">(700 Poin)</p>
                                </div>
                            </div>
                            <button
                                class="bg-red-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-600 transition hover:scale-105">
                                BATALKAN
                            </button>
                        </div>
                    </div> 
                    -->
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
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-sm border-t border-white/10 max-w-md mx-auto">
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
            <a href="{{ route('member.rewards') }}" class="flex flex-col items-center text-emerald-400 transition">
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
                <span class="text-xs mt-1">Profile</span>
            </a>
        </div>
    </div>

    <?php
    // You can add PHP logic here for dynamic rewards data
    /*
    $userPoints = 6700;
    
    $rewards = [
        ['name' => 'Handuk Gym', 'points' => 500, 'icon' => 'gift', 'status' => 'available'],
        ['name' => 'Tumblr', 'points' => 600, 'icon' => 'star', 'status' => 'available'],
        ['name' => 'Diskon 20% Membership', 'points' => 700, 'icon' => 'discount', 'status' => 'pending']
    ];
    */
    ?>

</body>

</html>