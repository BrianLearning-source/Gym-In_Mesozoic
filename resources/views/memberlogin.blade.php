<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Anggota</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .header-glow {
            text-shadow: 0px 5px 10px rgba(255, 255, 255, 0.4);
        }
    </style>
</head>

<body class="bg-black md:mx-11">
    <!-- Title -->
    <h1 class="text-6xl font-bold text-white text-center header-glow mt-12">Gym-In</h1>

    <div class="flex flex-col justify-center items-center mt-20 px-10">
        <p class="text-white text-1xl text-center py-3 drop-shadow-2xl">
            Untuk membuat akun, anda harus menjadi anggota gym.
            Anda bisa mengisi formulir yang berada di halaman utama
            atau daftar ke gym.
        </p>
        <div
            class="flex flex-col justify-center items-center backdrop-blur-2xl drop-shadow-2xl bg-white bg-opacity-20 rounded-3xl w-fit h-fit mt-6">
            <div class=" m-11">
                <h1 class="text-2xl font-bold text-white text-center header-glow uppercase">Login</h1>

                <form action="" class="flex flex-col gap-4 p-6">
                    <input type="text" placeholder="Username"
                        class="bg-white bg-opacity-20 text-white placeholder:text-white placeholder:opacity-75 border border-white border-opacity-50 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-white">
                    <input type="password" placeholder="Password"
                        class="bg-white bg-opacity-20 text-white placeholder:text-white placeholder:opacity-75 border border-white border-opacity-50 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-white">
                    <button type="submit" class=" text-white font-bold uppercase py-3 px-6 rounded-lg w-full"
                        style="background-color: rgba(77, 145, 132)">Login</button>
                </form>
            </div>
        </div>

        <div class="py-6">
            <p class="text-white text-1xl text-center drop-shadow-2xl">
                Jika terdapat kendala seperti lupa kata sandi, mohon
                kontak kami di
            </p>
            <p class="text-green-400 text-1xl text-center drop-shadow-2xl">+62 767-6767-6767</p>
        </div>
    </div>
</body>

</html>