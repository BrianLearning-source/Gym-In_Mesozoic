<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil Anggota - GYM-IN</title>

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
        <h1 class="mt-6 text-6xl font-bold text-center text-white md:mt-12 header-glow">GYM-IN</h1>

        <!-- Back Button -->
        <div class="w-full max-w-6xl mt-8">
            <a href="/member"
                class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>

        <!-- Profile Header Section -->
        <div class="relative w-full max-w-6xl my-6">
            <!-- Profile Banner -->
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-800/50 to-teal-800/50 backdrop-blur-sm">
                <!-- Profile Cover Image Placeholder -->
                {{-- <div class="h-32 md:h-48 bg-gradient-to-r from-emerald-900/30 to-teal-900/30"></div> --}}

                <!-- Profile Info -->
                <div class="relative px-6 py-6 flex flex-col justify-center items-center">
                    <!-- Avatar -->
                    <div
                        class="w-24 h-24 rounded-full border-4 border-emerald-500 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-600 shadow-xl">
                        <img src="https://pbs.twimg.com/media/E8YT2mbVcAIA5vv?format=jpg&name=small"
                            alt="Profile" class="w-full h-full object-cover">
                    </div>

                    <!-- Name and Title -->
                    <div class="mx-2 my-4 flex flex-col justify-center items-center">
                        <h2 class="text-2xl font-bold text-white md:text-3xl text-center">Grand Regentt Brian</h2>
                        <p class="text-emerald-400 text-center">The Veteran Bodybuilder</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid 1 -->
        <div class="w-full max-w-6xl gap-4 mt-8 flex flex-row flex-wrap justify-center items-center">
            <!-- Card 1 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">6/7/1991</p>
                <p class="mt-2 text-sm text-gray-300">Tanggal bergabung</p>
            </div>

            <!-- Card 2 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">670 Hari</p>
                <p class="mt-2 text-sm text-gray-300">Streak tertinggi</p>
            </div>

            <!-- Card 3 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">4020 Jam</p>
                <p class="mt-2 text-sm text-gray-300">Total waktu latihan</p>
            </div>
        </div>

        <!-- Data Anggota & Stat Anggota Section -->
        <div class="grid w-full max-w-6xl grid-cols-1 gap-6 mt-8 lg:grid-cols-2">

            <!-- Data Anggota Card -->
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-6 text-xl font-bold text-white">Data Anggota</h3>

                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-gray-300">Gender</span>
                        <span class="font-semibold text-white">Laki-laki</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-gray-300">Email</span>
                        <span class="font-semibold text-white">brianserafino@gmail.com</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-gray-300">No. Telp</span>
                        <span class="font-semibold text-white">+62 828-8282-8282</span>
                    </div>
                </div>
            </div>

            <!-- Stat Anggota Card -->
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-6 text-xl font-bold text-white">Stat Anggota</h3>

                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-gray-300">Berat Badan</span>
                        <span class="font-semibold text-white">181 kg</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-gray-300">Tinggi Badan</span>
                        <span class="font-semibold text-white">198 cm</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid 2 -->
        <div class="w-full max-w-6xl gap-4 mt-4 flex flex-row flex-wrap justify-center items-center">
            <!-- Card 4 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">6 jam</p>
                <p class="mt-2 text-sm text-gray-300">Latihan hari ini</p>
            </div>

            <!-- Card 5 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">67 Hari</p>
                <p class="mt-2 text-sm text-gray-300">Streak saat ini</p>
            </div>

            <!-- Card 6 -->
            <div class="w-[calc(50%-0.5rem)] p-6 rounded-xl backdrop-blur-sm bg-white/10 stat-card">
                <p class="text-2xl font-bold text-white md:text-3xl">6700</p>
                <p class="mt-2 text-sm text-gray-300">Poin streak</p>
            </div>
        </div>

        <!-- Personalisasi Section - Updated with Buttons -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h3 class="mb-6 text-xl font-bold text-white">Personalisasi</h3>

                <!-- Buttons Container -->
                <div class="flex flex-col gap-4">
                    <button type="button"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full hover:scale-110 transform transition duration-300"
                        style="background-color: rgba(77, 145, 132)">
                        Edit Profil
                    </button>

                    <button type="button"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full hover:scale-110 transform transition duration-300"
                        style="background-color: rgba(77, 145, 132)">
                        Ubah Password
                    </button>

                    <button type="button"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full hover:scale-110 transform transition duration-300"
                        style="background-color: rgba(77, 145, 132)">
                        Pengaturan Notifikasi
                    </button>

                    <button type="button"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full hover:scale-110 transform transition duration-300"
                        style="background-color: rgba(77, 145, 132)">
                        Preferensi Latihan
                    </button>
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
    // You can add PHP logic here, for example:
    // - Fetch user data from database
    // - Check if user is logged in
    // - Calculate dynamic stats
    
    /*
    // Example of dynamic PHP data:
    $userData = [
        'name' => 'Grand Regentt Brian',
        'title' => 'The Veteran Bodybuilder',
        'join_date' => '1991-07-06',
        'email' => 'brianserafino@gmail.com',
        'phone' => '+62 828-8282-8282',
        'gender' => 'Laki-laki',
        'weight' => 181,
        'height' => 198,
        'highest_streak' => 670,
        'current_streak' => 67,
        'streak_points' => 6700,
        'total_hours' => 4020,
        'today_hours' => 6
    ];
    */
    ?>

</body>

</html>