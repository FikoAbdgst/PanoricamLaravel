{{-- hero.blade --}}

<div class="py-12 bg-[#FEF3E2] font-['Poppins'] h-screen relative" data-aos="fade-in" data-aos-duration="1500">
    <!-- Left side floating photo frames -->
    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 z-30 hidden md:block" data-aos="slide-right"
        data-aos-duration="1200" data-aos-delay="400" data-aos-easing="ease-out-back">
        <div class="relative">
            <!-- Frame 1 - Multi-photo frame with increased rotation -->
            <div class="absolute -left-16 -top-20 transform shadow-2xl frame-left-rotate"
                data-aos="zoom-in-right-rotated" data-aos-duration="800" data-aos-delay="600">
                <div class="w-56 bg-white border-4 border-[#BF3131] rounded-lg relative pt-8 pb-4 shadow-lg">
                    <div class="border-2 border-[#BF3131] mx-2">
                        <div class="absolute top-2 right-2" data-aos="flip-left" data-aos-duration="600"
                            data-aos-delay="1000">
                            <svg class="w-5 h-5 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 px-2">
                        <!-- Photo slot 1 -->
                        <div class="relative" data-aos="fade-right" data-aos-duration="600" data-aos-delay="800">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/m1.jpeg') }}" alt="Memory placeholder 1"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                        <!-- Photo slot 2 -->
                        <div class="relative" data-aos="fade-right" data-aos-duration="600" data-aos-delay="900">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/m2.jpeg') }}" alt="Memory placeholder 2"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                        <!-- Photo slot 3 -->
                        <div class="relative" data-aos="fade-right" data-aos-duration="600" data-aos-delay="1000">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/m3.jpeg') }}" alt="Memory placeholder 3"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right side floating photo frames -->
    <div class="absolute right-0 top-1/2 transform -translate-y-1/2 z-30 hidden md:block" data-aos="slide-left"
        data-aos-duration="1200" data-aos-delay="500" data-aos-easing="ease-out-back">
        <div class="relative">
            <!-- Frame 1 - Multi-photo frame with increased rotation -->
            <div class="absolute -right-16 -top-20 transform shadow-2xl frame-right-rotate"
                data-aos="zoom-in-left-rotated" data-aos-duration="800" data-aos-delay="700">
                <div class="w-56 bg-white border-4 border-[#BF3131] rounded-lg relative pt-8 pb-4 shadow-lg">
                    <div class="border-2 border-[#BF3131] mx-2">
                        <div class="absolute top-2 left-2" data-aos="flip-right" data-aos-duration="600"
                            data-aos-delay="1100">
                            <svg class="w-5 h-5 text-[#BF3131]" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 px-2">
                        <!-- Photo slot 1 -->
                        <div class="relative" data-aos="fade-left" data-aos-duration="600" data-aos-delay="900">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/k1.jpeg') }}" alt="Memory placeholder 1"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                        <!-- Photo slot 2 -->
                        <div class="relative" data-aos="fade-left" data-aos-duration="600" data-aos-delay="1000">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/k2.jpeg') }}" alt="Memory placeholder 2"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                        <!-- Photo slot 3 -->
                        <div class="relative" data-aos="fade-left" data-aos-duration="600" data-aos-delay="1100">
                            <div class="h-32 overflow-hidden flex justify-center rounded">
                                <img src="{{ asset('images/k3.jpeg') }}" alt="Memory placeholder 3"
                                    class="object-cover w-full h-full" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative elements -->
    <div class="absolute inset-0 z-20">
        <div class="absolute top-1/4 left-1/4 w-12 h-12 text-red-500 opacity-20" data-aos="zoom-in"
            data-aos-duration="1000" data-aos-delay="1500" data-aos-easing="ease-out-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-16 h-16 text-red-500 opacity-20" data-aos="zoom-in"
            data-aos-duration="1000" data-aos-delay="1700" data-aos-easing="ease-out-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
    </div>

    <!-- Main content -->
    <div class="max-w-7xl h-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center relative z-20">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl"
                data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" data-aos-easing="ease-out-cubic">
                Photobooth App
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500" data-aos="fade-up" data-aos-duration="800"
                data-aos-delay="400" data-aos-easing="ease-out-cubic">
                Abadikan momen spesial kamu dengan frame keren dan berbagi dengan teman-teman!
            </p>
            <div class="mt-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600"
                data-aos-easing="ease-out-back">
                <button id="scrollToContentBtn"
                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#BF3131] hover:bg-[#F16767] transition duration-300 shadow-sm hover:shadow-lg cursor-pointer hover:scale-105"
                    data-aos="pulse" data-aos-duration="2000" data-aos-delay="1200" data-aos-infinite="true">
                    Mulai Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('scrollToContentBtn').addEventListener('click', function() {
        const contentSection = document.querySelector('.content_section');
        contentSection.scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

<!-- Custom AOS Configuration -->
<script>
    // Initialize AOS with custom settings
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        mirror: false,
        anchorPlacement: 'top-bottom',
        offset: 120,
        delay: 0,
        startEvent: 'DOMContentLoaded',
        initClassName: 'aos-init',
        animatedClassName: 'aos-animate',
        useClassNames: false,
        disableMutationObserver: false,
        debounceDelay: 50,
        throttleDelay: 99,
    });

    // Add custom CSS for enhanced animations
    const style = document.createElement('style');
    style.textContent = `
        [data-aos="slide-right"] {
            transform: translate3d(-100%, 0, 0);
            opacity: 0;
        }
        [data-aos="slide-right"].aos-animate {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
        
        [data-aos="slide-left"] {
            transform: translate3d(100%, 0, 0);
            opacity: 0;
        }
        [data-aos="slide-left"].aos-animate {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
        
        [data-aos="zoom-in-right-rotated"] {
            transform: translate3d(-100%, 0, 0) scale(0.6);
            opacity: 0;
        }
        [data-aos="zoom-in-right-rotated"].aos-animate {
            transform: translate3d(0, 0, 0) scale(1);
            opacity: 1;
        }
        
        [data-aos="zoom-in-left-rotated"] {
            transform: translate3d(100%, 0, 0) scale(0.6);
            opacity: 0;
        }
        [data-aos="zoom-in-left-rotated"].aos-animate {
            transform: translate3d(0, 0, 0) scale(1);
            opacity: 1;
        }

        /* Frame rotation classes for final state */
        .frame-left-rotate {
            transform: rotate(-12deg);
        }
        
        .frame-right-rotate {
            transform: rotate(12deg);
        }
        
        /* Override animations to maintain rotation */
        .frame-left-rotate[data-aos="zoom-in-right-rotated"] {
            transform: translate3d(-100%, 0, 0) scale(0.6) rotate(-12deg);
            opacity: 0;
        }
        .frame-left-rotate[data-aos="zoom-in-right-rotated"].aos-animate {
            transform: translate3d(0, 0, 0) scale(1) rotate(-12deg);
            opacity: 1;
        }
        
        .frame-right-rotate[data-aos="zoom-in-left-rotated"] {
            transform: translate3d(100%, 0, 0) scale(0.6) rotate(12deg);
            opacity: 0;
        }
        .frame-right-rotate[data-aos="zoom-in-left-rotated"].aos-animate {
            transform: translate3d(0, 0, 0) scale(1) rotate(12deg);
            opacity: 1;
        }
        
        [data-aos="flip-left"] {
            transform: rotateY(90deg);
            opacity: 0;
        }
        [data-aos="flip-left"].aos-animate {
            transform: rotateY(0deg);
            opacity: 1;
        }
        
        [data-aos="flip-right"] {
            transform: rotateY(90deg);
            opacity: 0;
        }
        [data-aos="flip-right"].aos-animate {
            transform: rotateY(0deg);
            opacity: 1;
        }
        
        /* Enhanced easing functions */
        [data-aos-easing="ease-out-back"] {
            transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        [data-aos-easing="ease-out-cubic"] {
            transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
        }
        
        [data-aos-easing="ease-out-bounce"] {
            transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        /* Pulse animation for button */
        [data-aos="pulse"] {
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
    `;
    document.head.appendChild(style);
</script>
