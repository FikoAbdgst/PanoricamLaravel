<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Photobooth App' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    {{-- jQuery dan Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- Tailwind CSS via CDN - Paling reliable --}}
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Add these lines -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>




    @stack('styles')
</head>

<body class="bg-[#FEF3E2] overflow-x-hidden">
    @include('components.navbar')
    <main>
        @yield('hero_section')
        @yield('content_section')
        @yield('howitworks_section')
        @yield('testimoni_section')
        @yield('footer_section')
    </main>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                const originalClasses = navbar.className;
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 10) {
                        navbar.className =
                            'fixed top-0 left-0 right-0 bg-[#FEF3E2] shadow-md w-full h-20 z-50 transition-all duration-300';
                    } else {
                        navbar.className = originalClasses;
                    }
                });
            }
        });
    </script>

    <script>
        // Fungsi untuk menangani scroll dan animasi
        function handleScrollAnimations() {
            const sections = document.querySelectorAll('section, div[class*="section"]');
            const windowHeight = window.innerHeight;
            const scrollPosition = window.scrollY;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionBottom = sectionTop + sectionHeight;

                // Jika section masuk ke viewport
                if (scrollPosition + windowHeight > sectionTop && scrollPosition < sectionBottom) {
                    // Trigger animasi
                    section.querySelectorAll('[data-aos]').forEach(element => {
                        // Tambahkan pengecekan apakah element sudah pernah di-animasi
                        if (!element.classList.contains('aos-animate')) {
                            element.classList.add('aos-animate');
                        }
                    });
                }
                // Hapus else condition yang mereset animasi
            });
        }

        // Inisialisasi AOS dengan pengaturan khusus
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: false, // Ubah ke false untuk memungkinkan animasi diulang
                mirror: true,
                offset: 120
            });

            // Tambahkan event listener untuk scroll
            window.addEventListener('scroll', handleScrollAnimations);

            // Jalankan sekali saat pertama kali dimuat
            handleScrollAnimations();
        });

        (function() {
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        handleScrollAnimations();
                        ticking = false;
                    });
                    ticking = true;
                }
            });
        })();
    </script>

    <style>
        /* Tambahkan CSS untuk transisi yang lebih halus */
        [data-aos] {
            transition-property: transform, opacity;
            transition-timing-function: ease-in-out;
            will-change: transform, opacity;
            /* Optimasi performa */
        }

        /* Pastikan elemen yang di-animasi memiliki transform origin yang tepat */
        [data-aos^="fade"][data-aos^="fade"],
        [data-aos^="zoom"][data-aos^="zoom"] {
            transform-origin: center center;
        }

        [data-aos^="slide"][data-aos^="slide"] {
            transform-origin: top center;
        }
    </style>
</body>

</html>
