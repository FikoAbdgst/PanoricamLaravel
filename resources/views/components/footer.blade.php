<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panoricam Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }

        .floating-animation:nth-child(2) {
            animation-delay: 1s;
        }

        .floating-animation:nth-child(3) {
            animation-delay: 2s;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .instagram-gradient {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .instagram-hover {
            transition: all 0.3s ease;
        }

        .instagram-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(240, 148, 51, 0.4);
        }

        .camera-icon {
            transition: transform 0.3s ease;
        }

        .camera-icon:hover {
            transform: rotate(15deg) scale(1.1);
        }

        .gradient-text {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 3s ease-in-out infinite;
        }

        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .back-to-top {
            transition: all 0.3s ease;
        }

        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .footer-decoration {
            position: absolute;
            opacity: 0.1;
            pointer-events: none;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .contact-info {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <!-- Improved Footer -->
    <footer
        class="bg-gradient-to-br from-[#BF3131] via-[#A02828] to-[#8B1F1F] text-white font-['Poppins'] relative overflow-hidden">
        <!-- Animated background decorations -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="footer-decoration absolute top-10 left-10 w-20 h-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
            </div>
            <div class="footer-decoration absolute bottom-10 right-10 w-16 h-16">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z" />
                </svg>
            </div>
        </div>

        <!-- Floating camera icons -->
        <div class="absolute inset-0 pointer-events-none">

            <div class="floating-animation absolute top-1/2 right-1/4 w-10 h-10 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5zM17.5 6.5c0-.83-.67-1.5-1.5-1.5h-1.79l-.74-.74c-.19-.19-.44-.29-.71-.29H10.24c-.27 0-.52.1-.71.29L8.79 5H7c-.83 0-1.5.67-1.5 1.5v9c0 .83.67 1.5 1.5 1.5h10c.83 0 1.5-.67 1.5-1.5v-9z" />
                </svg>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
            <!-- Main footer content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

                <!-- Brand Section -->
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start mb-6">
                        <div class="camera-icon mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-10 h-10">
                                <path
                                    d="M12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5zM17.5 6.5c0-.83-.67-1.5-1.5-1.5h-1.79l-.74-.74c-.19-.19-.44-.29-.71-.29H10.24c-.27 0-.52.1-.71.29L8.79 5H7c-.83 0-1.5.67-1.5 1.5v9c0 .83.67 1.5 1.5 1.5h10c.83 0 1.5-.67 1.5-1.5v-9z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold">
                            <span class="text-red-300">P</span><span class="text-pink-300">A</span><span
                                class="text-green-400">N</span><span class="text-yellow-300">O</span><span
                                class="text-blue-300">R</span><span class="text-purple-400">I</span><span
                                class="text-yellow-300">C</span><span class="text-blue-300">A</span><span
                                class="text-orange-300">M</span>
                        </h1>
                    </div>
                    <p class="text-white/80 text-lg leading-relaxed mb-6">
                        Abadikan momen spesial Anda dengan frame keren dan berbagi dengan teman-teman!
                    </p>

                </div>

                <!-- Instagram Section -->
                <div class="text-center">
                    <h3 class="text-xl font-semibold mb-6">Ikuti Kami</h3>
                    <div class="flex justify-center mb-6">
                        <a href="https://instagram.com/panoricam" target="_blank" rel="noopener noreferrer"
                            class="instagram-gradient instagram-hover rounded-2xl p-4 inline-flex items-center space-x-3 text-white font-medium shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-6 h-6">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <span>@panoricam</span>
                        </a>
                    </div>
                    <p class="text-white/70 text-sm">
                        Lihat foto-foto terbaru dan dapatkan inspirasi untuk event Anda berikutnya!
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="text-center md:text-right">
                    <h3 class="text-xl font-semibold mb-6">Hubungi Kami</h3>
                    <div class="contact-info rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-center md:justify-end mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-5 h-5 mr-2">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                            <span class="text-white/90">+62 882-0013-30851</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-5 h-5 mr-2">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <span class="text-white/90">panoricam5@gmail.com</span>
                        </div>
                    </div>
                    <div class="feature-card rounded-lg p-3">
                        <div class="flex items-center justify-center md:justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-4 h-4 mr-2">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            <span class="text-sm text-white/80">Banjar, Jawa Barat</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom section -->
            <div class="border-t border-white/20 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center mb-4 md:mb-0">
                        <p class="text-white/70 text-sm">
                            © 2025 Panoricam. All rights reserved.
                        </p>
                    </div>

                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-white/70 hover:text-white text-sm transition-colors">
                            Privacy Policy
                        </a>
                        <a href="#" class="text-white/70 hover:text-white text-sm transition-colors">
                            Terms of Service
                        </a>
                        <button onclick="scrollToTop()"
                            class="back-to-top bg-white/20 hover:bg-white/30 rounded-full p-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="w-5 h-5">
                                <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe footer elements
            const footerElements = document.querySelectorAll('footer > div > *');
            footerElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
