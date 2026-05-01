<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout History - GYM-IN</title>

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

        .history-row {
            transition: background-color 0.2s ease;
        }

        .history-row:hover {
            background-color: rgba(255, 255, 255, 0.05);
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
            <a href="/memberdashboard" 
               class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>

        <!-- Page Title -->
        <div class="w-full max-w-6xl mt-6">
            <div class="mb-2">
                <h2 class="text-2xl font-bold text-white">Riwayat Latihan</h2>
                <p class="text-sm text-gray-400 mt-1">Lihat perkembangan latihan Anda dari waktu ke waktu</p>
            </div>
        </div>

        <!-- Weekly Calendar / Day Selector -->
        <div class="w-full max-w-6xl mt-4">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <div class="flex justify-between gap-2">
                    <!-- Day 1 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Sen</p>
                        <p class="text-sm font-semibold text-white">10</p>
                    </div>
                    <!-- Day 2 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Sel</p>
                        <p class="text-sm font-semibold text-white">11</p>
                    </div>
                    <!-- Day 3 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Rab</p>
                        <p class="text-sm font-semibold text-white">12</p>
                    </div>
                    <!-- Day 4 - Active -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-emerald-500/20 border border-emerald-500/30">
                        <p class="text-xs text-emerald-400">Kam</p>
                        <p class="text-sm font-semibold text-emerald-400">13</p>
                    </div>
                    <!-- Day 5 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Jum</p>
                        <p class="text-sm font-semibold text-white">14</p>
                    </div>
                    <!-- Day 6 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Sab</p>
                        <p class="text-sm font-semibold text-white">15</p>
                    </div>
                    <!-- Day 7 -->
                    <div class="flex-1 text-center py-3 rounded-lg bg-white/5">
                        <p class="text-xs text-gray-400">Min</p>
                        <p class="text-sm font-semibold text-white">16</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Workout Summary Card -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Latihan Hari Ini</h3>
                    <span class="text-sm text-emerald-400">{{ $perkembangan->date->format('l, j F Y') ?? 'Tanggal tidak tersedia' }}</span>
                </div>
                <div class="flex flex-row flex-wrap items-center justify-center gap-8">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-emerald-400">{{ $duration ? $duration->duration : 'Durasi tidak tersedia' }} jam</p>
                        <p class="text-sm text-gray-300">Durasi</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-orange-400">{{ $perkembangan->calory_burned ?? 'Kalori tidak tersedia' }} kkal</p>
                        <p class="text-sm text-gray-300">Total kalori</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-blue-400">{{ $perkembangan->weight ?? 'Berat tidak tersedia' }} kg</p>
                        <p class="text-sm text-gray-300">Max Weight</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Stats Cards -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Statistik Minggu Ini</h3>
                <div class="flex flex-wrap gap-4 items-center justify-center">
                    <!-- Card 1 -->
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">67 jam</div>
                        <p class="text-sm text-gray-300">Total Latihan</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">24 jam</div>
                        <p class="text-sm text-gray-300">Total Durasi</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">1,850 kkal</div>
                        <p class="text-sm text-gray-300">Total Kalori</p>
                    </div>
                    <!-- Card 4 -->
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">95 kg</div>
                        <p class="text-sm text-gray-300">PR Week</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workout History Table -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Riwayat Latihan Detail</h3>
                
                <!-- Table Header -->
                <div class="grid grid-cols-5 gap-2 px-4 py-3 mb-2 border-b border-white/10 text-sm font-semibold text-gray-400">
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
                    <div class="text-emerald-400">1.5 jam</div>
                    <div class="text-orange-400">250 kkal</div>
                    <div class="text-blue-400">85 kg</div>
                </div>
                
                <!-- Row 2 - Tuesday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Selasa</div>
                    <div class="text-gray-300">11/03</div>
                    <div class="text-emerald-400">2 jam</div>
                    <div class="text-orange-400">320 kkal</div>
                    <div class="text-blue-400">88 kg</div>
                </div>
                
                <!-- Row 3 - Wednesday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-b border-white/5 text-sm">
                    <div class="text-white">Rabu</div>
                    <div class="text-gray-300">12/03</div>
                    <div class="text-emerald-400">1.8 jam</div>
                    <div class="text-orange-400">290</div>
                    <div class="text-blue-400">87 kg</div>
                </div>
                
                <!-- Row 4 - Thursday (Today - Highlighted) -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 rounded-lg bg-emerald-500/10 text-sm">
                    <div class="text-emerald-400 font-semibold">Kamis</div>
                    <div class="text-emerald-400">13/03</div>
                    <div class="text-emerald-400">2.2 j</div>
                    <div class="text-orange-400">340</div>
                    <div class="text-blue-400">90 kg</div>
                </div>
                
                <!-- Row 5 - Friday -->
                <div class="history-row grid grid-cols-5 gap-2 px-4 py-3 border-t border-white/5 text-sm">
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
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Progres Berat Badan</h3>
                
                <!-- Bar chart -->
                <div class="flex items-end justify-between gap-2 h-40 mb-4">
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg transition-all hover:bg-emerald-400" style="height: 60px;"></div>
                        <span class="text-sm text-gray-400 mt-2">85 kg</span>
                        <span class="text-xs text-gray-500">Sen</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg transition-all hover:bg-emerald-400" style="height: 70px;"></div>
                        <span class="text-sm text-gray-400 mt-2">88 kg</span>
                        <span class="text-xs text-gray-500">Sel</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-500 rounded-t-lg transition-all hover:bg-emerald-400" style="height: 65px;"></div>
                        <span class="text-sm text-gray-400 mt-2">87 kg</span>
                        <span class="text-xs text-gray-500">Rab</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-emerald-400 rounded-t-lg transition-all hover:bg-emerald-300" style="height: 75px;"></div>
                        <span class="text-sm text-emerald-400 mt-2 font-semibold">90 kg</span>
                        <span class="text-xs text-gray-500">Kam</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-white/20 rounded-t-lg" style="height: 0px;"></div>
                        <span class="text-sm text-gray-500 mt-2">-</span>
                        <span class="text-xs text-gray-500">Jum</span>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="flex justify-center gap-6 mt-4 pt-4 border-t border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        <span class="text-sm text-gray-400">Completed</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-white/20"></div>
                        <span class="text-sm text-gray-400">Not yet</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievement Section -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-gradient-to-r from-emerald-900/30 to-teal-900/30">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <div>
                        <p class="text-base font-semibold text-white">Pencapaian Terbaru!</p>
                        <p class="text-sm text-emerald-400">7 hari berturut-turut berolahraga</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="w-full max-w-6xl py-8 mt-4 text-center">
            <p class="text-white drop-shadow-2xl">
                Mengalami kendala? Kontak kami di:
            </p>
            <p class="text-emerald-400 hover:underline text-1xl drop-shadow-2xl mt-2">
                +62 767-6767-6767
            </p>
        </div>
    </div>

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