<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout History - GYM-IN</title>

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

        .history-row {
            transition: background-color 0.2s ease;
        }

        .history-row:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .day-active {
            background-color: rgba(196, 214, 176, 0.3);
            border-radius: 8px;
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

        <!-- Back Button -->
        <div class="mb-5">
            <a href="/member" 
               class="text-white/80 text-sm hover:text-white inline-flex items-center gap-1">
                <span>←</span> Kembali
            </a>
        </div>

        <!-- Page Title -->
        <div class="mb-4">
            <h2 class="text-xl font-bold text-white">Riwayat Latihan</h2>
            <p class="text-xs text-gray-400 mt-1">Lihat perkembangan latihan Anda dari waktu ke waktu</p>
        </div>

        <!-- Weekly Calendar / Day Selector -->
        <div class="mb-6">
            <div class="flex justify-between gap-1">
                <!-- Day 1 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Sen</p>
                    <p class="text-sm font-semibold text-white">10</p>
                </div>
                <!-- Day 2 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Sel</p>
                    <p class="text-sm font-semibold text-white">11</p>
                </div>
                <!-- Day 3 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Rab</p>
                    <p class="text-sm font-semibold text-white">12</p>
                </div>
                <!-- Day 4 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-emerald-500/20 border border-emerald-500/30">
                    <p class="text-xs text-emerald-400">Kam</p>
                    <p class="text-sm font-semibold text-emerald-400">13</p>
                </div>
                <!-- Day 5 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Jum</p>
                    <p class="text-sm font-semibold text-white">14</p>
                </div>
                <!-- Day 6 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Sab</p>
                    <p class="text-sm font-semibold text-white">15</p>
                </div>
                <!-- Day 7 -->
                <div class="flex-1 text-center py-2 rounded-lg bg-white/5">
                    <p class="text-xs text-gray-400">Min</p>
                    <p class="text-sm font-semibold text-white">16</p>
                </div>
            </div>
        </div>

        <!-- Today's Workout Summary Card -->
        <div class="mb-6">
            <div class="p-4 rounded-2xl backdrop-blur-sm bg-white/10">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-white">Latihan Hari Ini</h3>
                    <span class="text-xs text-emerald-400">Kamis, 13 Maret 2025</span>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1 text-center">
                        <p class="text-2xl font-bold text-emerald-400">18 j</p>
                        <p class="text-xs text-gray-400">Durasi</p>
                    </div>
                    <div class="flex-1 text-center">
                        <p class="text-2xl font-bold text-orange-400">300</p>
                        <p class="text-xs text-gray-400">Kkal</p>
                    </div>
                    <div class="flex-1 text-center">
                        <p class="text-2xl font-bold text-blue-400">90 kg</p>
                        <p class="text-xs text-gray-400">Max Weight</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Stats Cards (3 columns horizontal) -->
        <div class="mb-6">
            <h3 class="mb-3 text-sm font-semibold text-white">Statistik Minggu Ini</h3>
            <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                <!-- Card 1 -->
                <div class="stat-card flex-shrink-0 p-3 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[110px]">
                    <div class="text-xl font-bold text-emerald-400">67</div>
                    <p class="text-xs text-gray-300">Total Latihan</p>
                </div>
                <!-- Card 2 -->
                <div class="stat-card flex-shrink-0 p-3 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[110px]">
                    <div class="text-xl font-bold text-emerald-400">24 j</div>
                    <p class="text-xs text-gray-300">Total Durasi</p>
                </div>
                <!-- Card 3 -->
                <div class="stat-card flex-shrink-0 p-3 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[110px]">
                    <div class="text-xl font-bold text-emerald-400">1,850</div>
                    <p class="text-xs text-gray-300">Total Kkal</p>
                </div>
                <!-- Card 4 -->
                <div class="stat-card flex-shrink-0 p-3 text-center rounded-xl backdrop-blur-sm bg-white/10 min-w-[110px]">
                    <div class="text-xl font-bold text-emerald-400">95 kg</div>
                    <p class="text-xs text-gray-300">PR Week</p>
                </div>
            </div>
        </div>

        <!-- Workout History Table -->
        <div class="mb-6">
            <h3 class="mb-3 text-sm font-semibold text-white">Riwayat Latihan Detail</h3>
            
            <div class="rounded-2xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <!-- Table Header -->
                <div class="grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/10 text-xs font-semibold text-gray-400">
                    <div>Hari</div>
                    <div>Tanggal</div>
                    <div>Durasi</div>
                    <div>Kkal</div>
                    <div>Berat</div>
                </div>
                
                <!-- Row 1 - Monday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Senin</div>
                    <div class="text-gray-300">10/03</div>
                    <div class="text-emerald-400">1.5 j</div>
                    <div class="text-orange-400">250</div>
                    <div class="text-blue-400">85 kg</div>
                </div>
                
                <!-- Row 2 - Tuesday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Selasa</div>
                    <div class="text-gray-300">11/03</div>
                    <div class="text-emerald-400">2 j</div>
                    <div class="text-orange-400">320</div>
                    <div class="text-blue-400">88 kg</div>
                </div>
                
                <!-- Row 3 - Wednesday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Rabu</div>
                    <div class="text-gray-300">12/03</div>
                    <div class="text-emerald-400">1.8 j</div>
                    <div class="text-orange-400">290</div>
                    <div class="text-blue-400">87 kg</div>
                </div>
                
                <!-- Row 4 - Thursday (Today - Highlighted) -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 bg-emerald-500/10 text-sm">
                    <div class="text-emerald-400 font-semibold">Kamis</div>
                    <div class="text-emerald-400">13/03</div>
                    <div class="text-emerald-400">2.2 j</div>
                    <div class="text-orange-400">340</div>
                    <div class="text-blue-400">90 kg</div>
                </div>
                
                <!-- Row 5 - Friday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Jumat</div>
                    <div class="text-gray-300">14/03</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                </div>
                
                <!-- Row 6 - Saturday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Sabtu</div>
                    <div class="text-gray-300">15/03</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                </div>
                
                <!-- Row 7 - Sunday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 text-sm">
                    <div class="text-white">Minggu</div>
                    <div class="text-gray-300">16/03</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                    <div class="text-gray-400">-</div>
                </div>
            </div>
        </div>

        <!-- Progress Chart Section -->
        <div class="mb-6">
            <h3 class="mb-3 text-sm font-semibold text-white">Progres Berat Badan</h3>
            
            <div class="p-4 rounded-2xl backdrop-blur-sm bg-white/10">
                <!-- Simple bar chart representation -->
                <div class="flex items-end justify-between gap-2 h-32 mb-4">
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg" style="height: 60px;"></div>
                        <span class="text-xs text-gray-400 mt-2">85 kg</span>
                        <span class="text-xs text-gray-500">Sen</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg" style="height: 70px;"></div>
                        <span class="text-xs text-gray-400 mt-2">88 kg</span>
                        <span class="text-xs text-gray-500">Sel</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg" style="height: 65px;"></div>
                        <span class="text-xs text-gray-400 mt-2">87 kg</span>
                        <span class="text-xs text-gray-500">Rab</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-400 rounded-t-lg" style="height: 75px;"></div>
                        <span class="text-xs text-emerald-400 mt-2 font-semibold">90 kg</span>
                        <span class="text-xs text-gray-500">Kam</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-white/20 rounded-t-lg" style="height: 0px;"></div>
                        <span class="text-xs text-gray-500 mt-2">-</span>
                        <span class="text-xs text-gray-500">Jum</span>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="flex justify-center gap-4 mt-2 pt-3 border-t border-white/10">
                    <div class="flex items-center gap-1">
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        <span class="text-xs text-gray-400">Completed</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-3 h-3 rounded-full bg-white/20"></div>
                        <span class="text-xs text-gray-400">Not yet</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievement Section -->
        <div class="mb-6">
            <div class="p-4 rounded-2xl backdrop-blur-sm bg-gradient-to-r from-emerald-900/30 to-teal-900/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center">
                        <span class="text-xl">🏆</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Pencapaian Terbaru!</p>
                        <p class="text-xs text-emerald-400">7 hari berturut-turut berolahraga</p>
                    </div>
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

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>

    <?php
    // PHP Logic for dynamic data
    /*
    $workoutHistory = [
        ['day' => 'Senin', 'date' => '10/03', 'duration' => 1.5, 'calories' => 250, 'weight' => 85],
        ['day' => 'Selasa', 'date' => '11/03', 'duration' => 2.0, 'calories' => 320, 'weight' => 88],
        ['day' => 'Rabu', 'date' => '12/03', 'duration' => 1.8, 'calories' => 290, 'weight' => 87],
        ['day' => 'Kamis', 'date' => '13/03', 'duration' => 2.2, 'calories' => 340, 'weight' => 90],
        ['day' => 'Jumat', 'date' => '14/03', 'duration' => null, 'calories' => null, 'weight' => null],
        ['day' => 'Sabtu', 'date' => '15/03', 'duration' => null, 'calories' => null, 'weight' => null],
        ['day' => 'Minggu', 'date' => '16/03', 'duration' => null, 'calories' => null, 'weight' => null],
    ];
    
    $weeklyStats = [
        'total_workouts' => 67,
        'total_duration' => '24 j',
        'total_calories' => 1850,
        'pr_weight' => 95
    ];
    */
    ?>

</body>

</html>