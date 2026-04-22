<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Dashboard - GYM-IN</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .header-glow {
            text-shadow: 0px 5px 10px rgba(255, 255, 255, 0.4);
        }

        .bg-image {
            position: fixed;
            inset: 0;
            background-image: url("https://images.pexels.com/photos/4162449/pexels-photo-4162449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
            background-size: cover;
            background-position: center;
            opacity: 0.25;
            z-index: -2;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .reward-card {
            transition: all 0.3s ease;
            min-width: 110px;
            width: 110px;
            height: 170px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
            background-color: rgba(77, 145, 132, 0.9);
        }

        /* Custom range slider for gym density */
        .density-slider {
            position: relative;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #10b981 0%, #f59e0b 50%, #ef4444 100%);
            border-radius: 4px;
        }

        .density-handle {
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            border: 2px solid #10b981;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .density-handle:hover {
            transform: translate(-50%, -50%) scale(1.2);
        }

        /* Hide scrollbar but keep functionality */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-black">

    <!-- Background Image -->
    <div class="bg-image"></div>

    <!-- Main Container - Mobile First -->
    <div class="flex flex-col px-4 py-6 pb-24 max-w-md mx-auto">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-center text-white header-glow">GYM-IN</h1>
        </div>

        <!-- Welcome Section with Avatar -->
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-white md:text-2xl">Halo, Brian!</h2>
            <!-- Avatar Circle -->
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg flex items-center justify-center overflow-hidden border-2 border-white/20">
                <span class="text-xl text-white">👤</span>
            </div>
        </div>

        <!-- Combined Streak & Rewards Box -->
        <div class="p-5 mb-6 rounded-2xl backdrop-blur-sm bg-white/10">
            <!-- Streak Section inside box -->
            <div class="mb-5 text-center">
                <p class="text-base font-semibold text-white">
                    Anda telah berolahraga selama <span class="text-emerald-400">67 hari</span> berturut-turut!
                </p>
                <div class="flex items-center justify-center gap-2 mt-2">
                    <span class="text-yellow-400 text-lg">🪙</span>
                    <p class="text-white text-sm">Poin Streak anda: <span class="font-bold text-emerald-400">6700</span></p>
                </div>
            </div>

            <!-- Rewards Section - Horizontal Scroll (3 cards visible) -->
            <div>
                <h3 class="mb-3 text-xs font-semibold text-gray-300">Tukar poin untuk hadiah:</h3>
                <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2 -mx-1 px-1">
                    <!-- Reward 1 -->
                    <div class="reward-card flex-shrink-0 p-3 rounded-xl backdrop-blur-sm bg-white/5 flex flex-col">
                        <div class="flex-1">
                            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 15v6"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-center text-white">Handuk Gym</p>
                            <p class="text-xs text-center text-emerald-400">(500 Poin)</p>
                        </div>
                        <button class="btn-tukar bg-emerald-600/80 text-white py-1.5 rounded-lg font-semibold text-xs mt-2 hover:bg-emerald-600 transition">
                            TUKAR
                        </button>
                    </div>

                    <!-- Reward 2 -->
                    <div class="reward-card flex-shrink-0 p-3 rounded-xl backdrop-blur-sm bg-white/5 flex flex-col">
                        <div class="flex-1">
                            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-center text-white">Tumblr</p>
                            <p class="text-xs text-center text-emerald-400">(600 Poin)</p>
                        </div>
                        <button class="btn-tukar bg-emerald-600/80 text-white py-1.5 rounded-lg font-semibold text-xs mt-2 hover:bg-emerald-600 transition">
                            TUKAR
                        </button>
                    </div>

                    <!-- Reward 3 -->
                    <div class="reward-card flex-shrink-0 p-3 rounded-xl backdrop-blur-sm bg-white/5 flex flex-col">
                        <div class="flex-1">
                            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-center text-white">Diskon 20%</p>
                            <p class="text-xs text-center text-emerald-400">(700 Poin)</p>
                        </div>
                        <button class="btn-tukar bg-emerald-600/80 text-white py-1.5 rounded-lg font-semibold text-xs mt-2 hover:bg-emerald-600 transition">
                            TUKAR
                        </button>
                    </div>

                    <!-- Reward 4 (Bonus) -->
                    <div class="reward-card flex-shrink-0 p-3 rounded-xl backdrop-blur-sm bg-white/5 flex flex-col">
                        <div class="flex-1">
                            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-center text-white">Personal Trainer</p>
                            <p class="text-xs text-center text-emerald-400">(1000 Poin)</p>
                        </div>
                        <button class="btn-tukar bg-emerald-600/80 text-white py-1.5 rounded-lg font-semibold text-xs mt-2 hover:bg-emerald-600 transition">
                            TUKAR
                        </button>
                    </div>
                </div>
            </div>

            <!-- Explore Link -->
            <div class="mt-4 text-center">
                <a href="/member/rewards" class="text-emerald-400 hover:underline text-xs">
                    Jelajahi reward lainnya →
                </a>
            </div>
        </div>

        <!-- Today's Summary Section - Horizontal Scroll -->
        <div class="mb-6">
            <h3 class="mb-3 text-lg font-bold text-white">Ringkasan Hari ini</h3>
            
            <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2">
                <!-- Duration Card -->
                <div class="stat-card flex-shrink-0 p-4 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[140px]">
                    <div class="text-2xl font-bold text-emerald-400">18 j 21 m</div>
                    <p class="mt-1 text-xs text-gray-300">Latihan</p>
                    <div class="flex justify-center gap-3 mt-2">
                        <div>
                            <span class="text-xs text-gray-400">90 kg</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">100 kg</span>
                        </div>
                    </div>
                </div>

                <!-- Calories Card -->
                <div class="stat-card flex-shrink-0 p-4 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[140px]">
                    <div class="text-2xl font-bold text-orange-400">300 Kkal</div>
                    <p class="mt-1 text-xs text-gray-300">Kkal</p>
                </div>

                <!-- Progress Link Card -->
                <div class="stat-card flex-shrink-0 p-4 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[160px] flex flex-col items-center justify-center">
                    <a href="/member/progress" class="text-emerald-400 hover:underline text-xs">
                        Catat dan lihat perkembangan →
                    </a>
                </div>
            </div>
        </div>

        <!-- Gym Density Section with Handle/Slider -->
        <div class="mb-6">
            <h3 class="mb-3 text-lg font-bold text-white">Kepadatan Gym</h3>
            
            <div class="p-5 rounded-2xl backdrop-blur-sm bg-white/10">
                <!-- Density Slider with Handle -->
                <div class="mb-6">
                    <div class="flex justify-between mb-3">
                        <span class="text-xs text-gray-300">Occupancy</span>
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
                                <span class="text-xs font-semibold text-white bg-black/50 px-2 py-0.5 rounded-full">35%</span>
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
                    <p class="text-xs text-gray-400">*Data berdasarkan absen keluar-masuk di kasir.</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="py-4 text-center">
            <p class="text-sm text-white">
                Mengalami kendala? Kontak kami di:
            </p>
            <p class="mt-1 text-emerald-400 hover:underline text-sm">
                +62 767-6767-6767
            </p>
        </div>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-sm border-t border-white/10 max-w-md mx-auto">
        <div class="flex justify-around items-center px-4 py-3">
            <a href="/member/dashboard" class="flex flex-col items-center text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs mt-1">Home</span>
            </a>
            <a href="/progres" class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="text-xs mt-1">Perkembangan</span>
            </a>
            <a href="/rewards" class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs mt-1">Rewards</span>
            </a>
            <a href="/profile" class="flex flex-col items-center text-white/60 hover:text-emerald-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs mt-1">Profile</span>
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
        'avatar' => '👤',
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