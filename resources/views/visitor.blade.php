<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym-In</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .header-glow {
            text-shadow: 0px 5px 10px rgba(255, 255, 255, 0.4);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Base background for each section */
        .section-bg {
            position: relative;
            isolation: isolate;
            transition: all 0.5s ease-out;
        }

        .section-bg>.bg-image {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            z-index: -1;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* When section is visible, fade in the background */
        .section-bg.visible>.bg-image {
            opacity: 0.25;
        }

        /* Make gabung section brighter to show lighting */
        .section-bg.visible>.bg-gabung {
            opacity: 0.8 !important;
            /* Adjust this value (0.5 to 1.0) to control brightness */
        }

        /* Individual background images for each section */
        .bg-intro {
            background-image: url("https://images.pexels.com/photos/3839058/pexels-photo-3839058.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
        }

        .bg-density {
            background-image: url("https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
        }

        .bg-gabung {
            background-image: url("https://images.pexels.com/photos/4761779/pexels-photo-4761779.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
        }

        /* Fade-in animation for sections */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-section {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Parallax effect for backgrounds */
        .bg-image {
            background-attachment: fixed;
        }

        /* Hover effect for buttons */
        button {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Smooth transition for cards */
        .backdrop-blur-3xl {
            transition: all 0.4s ease;
        }

        .backdrop-blur-3xl:hover {
            transform: translateY(-5px);
            backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="bg-black">
    <!-- Header -->
    <div class="sticky top-0 bg-black bg-opacity-80 backdrop-blur-md w-full z-50 transition-all duration-300"
        id="header">
        <div class="flex items-center justify-between h-14 px-6 md:mx-11">
            <h1 class="text-2xl font-bold text-white">Gym-In</h1>
            <a href="/login/">
                <div class="bg-white w-8 h-8 rounded-full hover:scale-110 transition-transform duration-300"></div>
            </a>
        </div>
    </div>
    <!-- End Header -->

    <!-- Gym-In introduction text -->
    <div class="section-bg flex flex-col px-10 pb-20 h-screen fade-section" id="intro">
        <div class="bg-image bg-intro"></div>
        <div class="mt-auto md:mx-11">
            <div class="flex flex-col relative z-10">
                <h1 class="text-2xl font-bold text-white text-left header-glow">Gym-In</h1>
                <p class="text-white text-left pt-3 max-w-4xl">
                    Tempat berolahraga dimana anda bisa memantau perkembangan anda, melihat kepadatan gym, serta memberi
                    anda motivasi untuk berolahraga rutin dengan adanya fitur Streak langsung dari situs web aplikasi
                    kami!
                </p>
            </div>

            <button class="mt-8 bg-white text-black font-bold uppercase py-3 px-6 rounded-lg w-fit hover:scale-110">
                MARI BERGABUNG
            </button>

            <div class="text-white flex flex-col mt-8 justify-center items-center opacity-75 animate-bounce">
                <p class="font-semibold">Geser</p>
                <p class="font-semibold">⭣</p>
            </div>
        </div>
    </div>

    <!-- Streak and Reward showcase -->
    <div class="flex flex-col justify-center items-center py-16 px-10 md:mx-11">
        <div>
            <h1 class="text-2xl text-white text-center font-bold header-glow">
                Tetap Semangat! <br>
                Tetap Konsisten!
            </h1>
            <p class="text-white text-center pt-3 opacity-80">Semakin giat untuk berolahraga, semakin banyak hadiah yang
                menunggumu!</p>
        </div>

        <div class="flex flex-row justify-between items-center pt-7">
            {{-- <img src="" alt="" height="308px">
            <img src="" alt="" height="308px"> --}}
            <div style="height: 308px; background: #ffffff;"></div>
            <div style="height: 308px; background: #ffffff;"></div>
        </div>

        <p class="text-white text-center pt-3 opacity-80">Tukarkan Poin Streak kamu dengan berbagai hadiah!</p>
    </div>

    <!-- Kepadatan Gym showcase -->
    <div class="section-bg flex flex-col py-16 px-10 fade-section" id="density">
        <div class="bg-image bg-density"></div>
        <div class="md:mx-11">
            <div class="flex flex-col relative z-10">
                <h1 class="text-2xl text-white text-left font-bold header-glow">
                Khawatir Penuh? <br>
                Sumpek?
                </h1>
                <p class="text-white text-left pt-3 opacity-80">Cek kepadatan gym secara langsung di laman utama aplikasi!
                </p>
            </div>

            <div class="flex flex-row justify-between items-center pt-7">
                {{-- <img src="" alt="" height="308px">
                <img src="" alt="" height="308px"> --}}
                <div style="height: 308px; background: #ffffff;"></div>
            </div>

            <p class="text-white text-left pt-3 opacity-80">Kepadatan gym akan diperbarui setiap kali anggota datang dan
                keluar dari gym!</p>
        </div>
    </div>

    <!-- Perkembangan Gym showcase -->
    <div class="flex flex-col py-16 px-10 md:mx-11">
        <div class="flex flex-col justify-end items-end">
            <h1 class="text-2xl text-white text-right font-bold header-glow">
                Pantau Perkembanganmu!
            </h1>
            <p class="text-white text-right pt-3 opacity-80">Catat dan lihat seberapa pesat perjalananmu!</p>
        </div>

        <div class="flex flex-row justify-between items-center pt-7">
            {{-- <img src="" alt="" height="308px">
            <img src="" alt="" height="308px"> --}}
            <div style="height: 308px; background: #ffffff;"></div>
        </div>

        <p class="text-white text-right pt-3 opacity-80 flex flex-col justify-end items-end">Tunjukkanlah hasil kerja
            kerasmu yang sudah kamu peroleh!</p>
    </div>

    <!-- Tunggu apalagi ? -->
    <div class="section-bg flex flex-col justify-center items-center py-16 px-10 fade-section " id=gabung>
        <div class="bg-image bg-gabung"></div>
        <div class="flex flex-col relative z-10 md:mx-11">
            <div
                class="flex flex-col justify-center items-center py-7 px-10 bg-white bg-opacity-20 backdrop-blur-sm rounded-3xl">
                <h1 class="text-2xl text-white text-center font-bold header-glow">
                    Tunggu apalagi?
                </h1>
                <p class="text-white text-center pt-3 opacity-80">
                    Gabunglah bersama pejuang lainnya. <br>
                    Mulailah perjalananmu bersama
                </p>

                <h1 class="text-5xl text-white text-center font-bold py-10"
                    style="text-shadow: 0px 0px 25px rgba(255, 255, 255, 0.4)">
                    Gym-In
                </h1>

                <button class="mt-8 bg-white text-black font-bold uppercase py-3 px-6 rounded-lg w-fit hover:scale-110">
                    MARI BERGABUNG
                </button>
            </div>
        </div>

        <!-- Script Animation -->
        <script>
            // Intersection Observer for fade-in effects
        const observerOptions = {
            threshold: 0.1, // Trigger when 10% of element is visible
            rootMargin: '0px 0px -50px 0px' // Slightly adjust trigger point
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    
                    // Optional: Add a small delay for backgrounds
                    if (entry.target.classList.contains('section-bg')) {
                        const bgImage = entry.target.querySelector('.bg-image');
                        if (bgImage) {
                            bgImage.style.opacity = '0.25';
                        }
                    }
                }
            });
        }, observerOptions);

        // Observe all fade sections
        document.querySelectorAll('.fade-section').forEach(section => {
            observer.observe(section);
        });

        // Also observe section-bg for background fading
        document.querySelectorAll('.section-bg').forEach(section => {
            observer.observe(section);
        });

        // Optional: Header background change on scroll
        let header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('bg-opacity-65');
                header.style.backdropFilter = 'blur(12px)';
            } else {
                header.classList.remove('bg-opacity-65');
                header.style.backdropFilter = 'blur(8px)';
            }
        });

        // Add smooth scroll to buttons (optional)
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', (e) => {
                // Example: Scroll to next section
                const currentSection = button.closest('.fade-section');
                if (currentSection) {
                    const nextSection = currentSection.nextElementSibling;
                    if (nextSection && nextSection.classList.contains('fade-section')) {
                        e.preventDefault();
                        nextSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });
        </script>

</body>

</html>