<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout History - GYM-IN</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

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
        <div class="flex justify-center mt-12">
            <img src="{{ asset('img/GymInLogo.png') }}" 
                alt="Gym-In Logo" 
                class="h-20 md:h-28 w-auto header-glow"
                style="max-height: 112px;">
        </div>
        <!-- Back Button -->
        <div class="w-full max-w-6xl mt-8">
            <a href="{{ route('member.dashboard') }}"
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
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <form method="GET" action="{{ route('member.progres') }}" class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <label for="selected_date" class="text-sm font-medium text-gray-200">Pilih tanggal</label>
                        <input type="date" id="selected_date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}"
                            class="mt-1 rounded-xl border border-white/10 bg-black/20 px-3 py-2 text-sm text-white shadow-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/30" />
                    </div>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-400">
                        Tampilkan
                    </button>
                </form>
                <div class="flex justify-between gap-2">
                    @foreach ($weekDays as $day)
                    <a href="{{ route('member.progres', ['date' => $day['dateUrl']]) }}"
                        class="flex-1 text-center py-3 rounded-lg transition-all hover:scale-105 {{ $day['isSelected'] ? 'bg-emerald-500/20 border border-emerald-500/30' : 'bg-white/5 hover:bg-white/10' }}">
                        <p class="text-xs {{ $day['isSelected'] ? 'text-emerald-400' : 'text-gray-400' }}">{{
                            $day['hari_singkat'] }}</p>
                        <p class="text-sm font-semibold {{ $day['isSelected'] ? 'text-emerald-400' : 'text-white' }}">{{
                            $day['date']->format('j') }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Selected Day Workout Summary Card -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Latihan Hari ini</h3>
                    <span class="text-sm text-emerald-400">{{
                        optional($perkembangan->date)->locale('id')->translatedFormat('l, j F Y') ?? 'Tanggal tidak
                        tersedia' }}</span>
                </div>
                <div class="flex flex-row flex-wrap items-center justify-center gap-8">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-emerald-400">@if ($duration && $duration->total_minutes !==
                            null)
                            {{ intdiv($duration->total_minutes, 60) }} jam {{ $duration->total_minutes % 60 }} menit
                            @else
                            Durasi tidak tersedia
                            @endif</p>
                        <p class="text-sm text-gray-300">Durasi</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-orange-400">{{ $perkembangan->calory_burned ?? 'Kalori tidak
                            tersedia' }} kkal</p>
                        <p class="text-sm text-gray-300">Total kalori</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-blue-400">{{ $perkembangan->weight ?? 'Berat tidak tersedia'
                            }} kg</p>
                        <p class="text-sm text-gray-300">Berat Badan</p>
                    </div>
                </div>

                <!-- Diary Textbox -->
                <div class="mt-6">
                    <h4 class="mb-3 text-base font-semibold text-white">Catatan Latihan</h4>
                    <textarea id="diaryText" readonly rows="1"
                        class="w-full min-h-[160px] resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        oninput="autoResizeTextarea(this)">{{ $perkembangan->diary ?? 'Belum ada catatan untuk tanggal ini.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Weekly Stats Cards -->
        @php
        $totalLatihan = collect($weekDays)->whereNotNull('weight')->count();
        $totalMenit = collect($weekDays)->sum('duration');
        $totalKalori = collect($weekDays)->sum('calory_burned');
        $maxBerat = collect($weekDays)->max('weight');
        @endphp
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h3 class="mb-4 text-lg font-semibold text-white">Statistik Minggu Ini</h3>
                <div class="flex flex-wrap gap-4 items-center justify-center">
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">{{ $totalLatihan }} <br> hari</div>
                        <p class="text-sm text-gray-300"> Latihan <br>Minggu Ini</p>
                    </div>
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">@if ($totalMenit)
                            {{ intdiv($totalMenit, 60) }} jam {{ $totalMenit % 60 }} menit
                            @else
                            0 jam
                            @endif</div>
                        <p class="text-sm text-gray-300">Total Jam <br>Latihan</p>
                    </div>
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">{{ $totalKalori ? number_format($totalKalori) :
                            0 }} <br> kkal</div>
                        <p class="text-sm text-gray-300">Total <br>Kalori</p>
                    </div>
                    <div class="stat-card p-4 text-center rounded-xl backdrop-blur-sm bg-white/5 w-full max-w-[150px]">
                        <div class="text-2xl font-bold text-emerald-400">{{ $maxBerat ? $maxBerat : 0 }} <br> kg</div>
                        <p class="text-sm text-gray-300">Berat Badan Minggu Ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workout History Table -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h3 class="mb-4 text-lg font-semibold text-white">Riwayat Latihan Detail</h3>

                <!-- Table Header -->
                <div
                    class="grid grid-cols-5 gap-2 px-4 py-3 mb-2 border-b border-white/10 text-sm font-semibold text-gray-400">
                    <div>Hari</div>
                    <div>Tanggal</div>
                    <div>Durasi</div>
                    <div>Kkal</div>
                    <div>Berat</div>
                </div>

                @foreach ($weekDays as $day)
                <div
                    class="history-row grid grid-cols-5 gap-2 px-4 py-3 {{ !$loop->last ? 'border-b border-white/5' : '' }} {{ $day['isSelected'] ? 'rounded-lg bg-emerald-500/10' : '' }} text-sm">
                    <div class="{{ $day['isSelected'] ? 'text-emerald-400 font-semibold' : 'text-white' }}">{{
                        $day['hari_panjang'] }}</div>
                    <div class="{{ $day['isSelected'] ? 'text-emerald-400' : 'text-gray-300' }}">{{
                        $day['date']->format('d/m') }}</div>
                    <div class="{{ $day['duration'] ? 'text-emerald-400' : 'text-gray-400' }}">@if ($day['duration'])
                        {{ intdiv($day['duration'], 60) }}j {{ $day['duration'] % 60 }}m
                        @else
                        -
                        @endif</div>
                    <div class="{{ $day['calory_burned'] ? 'text-orange-400' : 'text-gray-400' }}">{{
                        $day['calory_burned'] ? $day['calory_burned'] . ' kkal' : '-' }}</div>
                    <div class="{{ $day['weight'] ? 'text-blue-400' : 'text-gray-400' }}">{{ $day['weight'] ?
                        $day['weight'] . ' kg' : '-' }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Progress Chart Section -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h3 class="mb-4 text-lg font-semibold text-white">Progres Berat Badan</h3>

                <div class="relative">
                    <canvas id="weightChart" height="180"></canvas>
                </div>

                <div class="flex justify-center gap-6 mt-4 pt-4 border-t border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        <span class="text-sm text-gray-400">Completed</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded" style="background-color: rgba(255,255,255,0.1);"></div>
                        <span class="text-sm text-gray-400">Not yet</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievement Section -->
        <div class="w-full max-w-6xl mt-8">
            <div
                class="p-6 rounded-xl backdrop-blur-sm bg-gradient-to-r from-emerald-900/30 to-teal-900/30 overflow-hidden">
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

        {{-- <!-- Diary Textbox -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10 overflow-hidden">
                <h3 class="mb-4 text-lg font-semibold text-white">Catatan Harian</h3>
                <textarea id="diaryText" readonly rows="1"
                    class="w-full min-h-[200px] resize-none overflow-hidden rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    oninput="autoResizeTextarea(this)">{{ $perkembangan->diary ?? 'Belum ada catatan.' }}</textarea>
            </div>
        </div> --}}

        <!-- Personalisasi Section  -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-6 text-xl font-bold text-white">Kelola Data</h3>

                <!-- Buttons Container -->
                <div class="flex flex-col gap-4">
                    <a href="{{ route('member.progressForm', ['date' => optional($perkembangan->date)->format('Y-m-d')]) }}"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full text-center hover:scale-110 transform transition duration-300 overflow-hidden"
                        style="background-color: rgba(77, 145, 132)">
                        {{ $perkembangan->exists ? 'Ubah Data' : 'Tambah Data' }}
                    </a>

                    <form action="{{ route('member.progressDelete') }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data untuk tanggal {{ optional($perkembangan->date)->locale('id')->translatedFormat('j F Y') }}? Aksi ini akan bersifat permanen dan tidak dapet dikembalikan.');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="date" value="{{ optional($perkembangan->date)->format('Y-m-d') }}">
                        <button type="submit"
                            class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full transform transition duration-300 overflow-hidden 
                            {{ $perkembangan->exists ? 'hover:scale-110 bg-red-600' : 'bg-white/10 text-gray-400 cursor-not-allowed' }}"
                            {{ !$perkembangan->exists ? 'disabled' : '' }}>
                            Hapus Data
                        </button>
                    </form>
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
            <a href="{{ route('member.progres') }}" class="flex flex-col items-center text-emerald-400 transition">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('weightChart').getContext('2d');

            const labels = @json($chartLabels);
            const weights = @json($chartWeights);

            const hasData = weights.some(w => w > 0);

            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, '#34d399');
            gradient.addColorStop(1, '#059669');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: weights,
                        backgroundColor: weights.map(w => w > 0 ? gradient : 'rgba(255,255,255,0.08)'),
                        borderColor: weights.map(w => w > 0 ? '#34d399' : 'rgba(255,255,255,0.1)'),
                        borderWidth: 1,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    animation: {
                        duration: 800,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: '#fff',
                            bodyColor: '#34d399',
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y > 0 ? context.parsed.y + ' kg' : 'Belum latihan';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255,255,255,0.06)',
                            },
                            ticks: {
                                color: 'rgba(255,255,255,0.5)',
                                font: { size: 11 },
                                callback: function(value) {
                                    return value + ' kg';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'rgba(255,255,255,0.5)',
                                font: { size: 11 },
                            }
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>