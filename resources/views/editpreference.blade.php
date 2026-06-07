<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preferensi Latihan</title>

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

    <!-- Background Image -->
    <div class="fixed inset-0 pointer-events-none" style="z-index: -2;">
        <div class="bg-image"></div>
    </div>

    <!-- Title -->
    <div class="flex justify-center mt-12">
        <img src="{{ asset('img/GymInLogo.png') }}" 
            alt="Gym-In Logo" 
            class="h-20 md:h-28 w-auto header-glow"
            style="max-height: 112px;">
    </div>

    <div class="flex flex-col justify-center items-center mt-5 px-10">

        <!-- Login Note -->
        <p class="text-white text-1xl text-center py-3 drop-shadow-2xl">
            Ubah preferensi latihan Anda di sini.
        </p>

        <!-- Back Button -->
        <div class="w-full max-w-6xl mt-8">
            <a href="{{ route('member.profile') }}"
                class="text-white font-semibold hover:underline hover:scale-105 transform transition duration-300 inline-flex items-center gap-2">
                <span>←</span> Kembali
            </a>
        </div>
        <!-- Login Form -->
        <div
            class="flex flex-col justify-center items-center backdrop-blur-sm drop-shadow-2xl bg-white bg-opacity-20 rounded-3xl w-fit h-fit mt-3.5 overflow-hidden">
            <div class=" m-11">
                <h1 class="text-2xl font-bold text-white text-center header-glow uppercase">Preferensi Latihan</h1>

                <form action="{{ route('preference.update') }}" method="POST" class="flex flex-col gap-4 p-6">
                    @csrf 
                    @method('PUT')

                    <!-- Error messages -->
                    @if ($errors->any())
                    <div class="bg-red-500 bg-opacity-20 border border-red-500 text-red-500 px-4 py-2 rounded-lg text-sm mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <input type="number" name="rest_day" 
                        value="{{ old('rest_day', $anggota->rest_days ?? '') }} "placeholder="Hari Libur (0-5)" min="0" max="5"
                        class="bg-white bg-opacity-20 text-white placeholder:text-white placeholder:opacity-75 border border-white border-opacity-50 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-white">
                        <p class="text-white text-sm">*Masukkan jumlah hari libur dalam seminggu (0-5), untuk mempertahankan <i>streak</i> Anda.</p>
                    <button type="submit"
                        class="text-white font-bold uppercase py-3 px-6 rounded-lg w-full hover:scale-110 transform transition duration-300 overflow-hidden"
                        style="background-color: rgba(77, 145, 132)">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>