<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Photo Strip Booth</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gif.js/0.2.0/gif.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <!-- Tambahkan di head -->
    <script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.3/dist/heic2any.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body class="m-0 font-['Poppins'] bg-[#FEF3E2] flex flex-col items-center relative min-h-screen">
    <a href="{{ route('frametemp') }}"
        class="hidden sm:block absolute top-14 left-14 z-50 text-2xl font-bold text-[#BF3131] bg-transparent border-none cursor-pointer hover:text-[#F16767]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-8 h-8" fill="currentColor">
            <path
                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>
    </a>
    <div class="w-full max-w-7xl py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center relative z-20">
        <h1 class="mb-5 font-semibold text-gray-800 text-5xl bg-transparent rounded-lg text-center">
            <span class="text-red-600">C</span><span class="text-pink-300">A</span><span
                class="text-green-400">P</span><span class="text-yellow-300">T</span><span
                class="text-blue-300">U</span><span class="text-purple-400">R</span><span
                class="text-yellow-300">E</span>
            <span class="text-blue-300">T</span><span class="text-green-300">I</span><span
                class="text-orange-300">M</span><span class="text-purple-400">E</span><span
                class="text-pink-300">!</span>
        </h1>

        <div class="flex flex-col md:flex-row gap-8 md:gap-20 items-start justify-center">
            <div class="w-full md:w-auto">
                <div class="relative mx-auto" style="width: min(90vw, 660px); max-width: 660px; aspect-ratio: 4/3;">
                    <video id="video" autoplay
                        class="w-full h-full bg-gray-200 rounded-xl shadow-md object-cover"></video>


                    <div id="countdown-overlay"
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-8xl font-bold text-white pointer-events-none"
                        style="text-shadow: 0 0 10px rgba(0, 0, 0, 0.7);"></div>
                    <div id="flash-overlay"></div>

                    <!-- Floating Settings Button -->
                    <button id="floatingSettingsToggle" class="floating-settings-toggle" title="Settings">
                        <i class="fa-solid fa-gear text-white"></i>
                    </button>

                    <!-- Floating Options (Hidden by default) -->
                    <div id="floatingOptions" class="floating-options hidden">
                        <button id="floatingCameraToggle" class="floating-option floating-camera-toggle"
                            title="Switch Camera">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                                <path
                                    d="M448 224c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zM224 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64zm-256 0c0-17.7 14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32s-32-14.3-32-32zm256 192c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                            </svg>
                        </button>
                        <button id="floatingMirrorToggle" class="floating-option floating-mirror-toggle"
                            title="Toggle Mirror: Off">
                            <i class="fa-solid fa-clone text-white mt-2"></i>
                        </button>
                        <button id="floatingCountdownToggle" class="floating-option floating-countdown-toggle"
                            title="Countdown: 3s">
                            <span class="countdown-text">3s</span>
                        </button>
                        <button id="floatingFlashToggle" class="floating-option floating-flash-toggle"
                            title="Flash: Off">
                            <i class="fa-solid fa-bolt text-white mt-2"></i>
                        </button>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-4 mt-5 flex-wrap">
                    <select id="filterSelect"
                        class="py-2 px-3 sm:py-2.5 sm:px-4 rounded-xl bg-white text-sm sm:text-base font-medium cursor-pointer border-2 border-[#BF3131] transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:text-white w-auto">
                        <option value="none">No Filter</option>
                        <option value="grayscale(100%)">Grayscale</option>
                        <option value="sepia(100%)">Sepia</option>
                        <option value="contrast(150%)">High Contrast</option>
                        <option value="brightness(120%)">Bright</option>
                    </select>


                </div>

                <div class="w-full flex flex-wrap justify-center items-center gap-4 mt-5">
                    <button id="captureButton"
                        class="bg-[#BF3131] flex gap-2 text-white border border-transparent py-3 px-6 text-base font-semibold rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5"
                            fill="currentColor">
                            <path
                                d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                        </svg>
                    </button>

                    <button id="uploadButton"
                        class="bg-[#BF3131] flex gap-2 text-white border border-transparent py-3 px-6 text-base font-semibold rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5"
                            fill="currentColor">
                            <path
                                d="M288 109.3L288 352c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-242.7-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352l128 0c0 35.3 28.7 64 64 64s64-28.7 64-64l128 0c35.3 0 64 28.7 64 64l0 32c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64l0-32c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                        </svg>
                        Upload Photo
                    </button>

                    <input type="file" id="fileInput" accept="image/*,.heic,.heif" class="hidden">
                </div>
            </div>

            <div class="w-[190px] h-[500px] relative frame-container">
                <div id="frameTemplate" class="w-full h-full relative bg-white rounded-lg shadow-lg">
                    @include($templatePath, ['frame' => $frame])

                    <!-- White overlay divs untuk placeholder -->
                    <div class="photo-overlay absolute top-[20px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="0"></div>
                    <div class="photo-overlay absolute top-[150px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="1"></div>
                    <div class="photo-overlay absolute top-[280px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="2"></div>

                    <!-- Watermark divs baru yang selalu di atas -->
                    @if (!$frame->isFree())
                        <div class="watermark absolute  top-[20px] left-[10px] w-[170px] h-[120px] z-20 pointer-events-none opacity-40"
                            data-slot="0">
                            <div class="flex items-center justify-center h-full  p-2 rounded-lg">
                                <img src="{{ asset('logo.png') }}" alt="Watermark" class="h-24">
                            </div>
                        </div>
                        <div class="watermark absolute top-[150px] left-[10px] w-[170px] h-[120px] z-20 pointer-events-none opacity-40"
                            data-slot="1">
                            <div class="flex items-center justify-center h-full  p-2 rounded-lg">
                                <img src="{{ asset('logo.png') }}" alt="Watermark" class="h-24">
                            </div>
                        </div>
                        <div class="watermark absolute top-[280px] left-[10px] w-[170px] h-[120px] z-20 pointer-events-none opacity-40"
                            data-slot="2">
                            <div class="flex items-center justify-center h-full  p-2 rounded-lg">
                                <img src="{{ asset('logo.png') }}" alt="Watermark" class="h-24">
                            </div>
                        </div>
                    @endif
                </div>
                <p class="text-[10px] text-center font-bold mt-5">TEKAN FOTO UNTUK RETAKE FOTO</p>
                <div class="flex flex-col justify-center items-center gap-4 mt-5">
                    <button id="resetButton"
                        class="bg-[#BF3131] text-white border border-transparent py-2 px-3 sm:py-2.5 sm:px-4 text-sm sm:text-base font-semibold rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg w-full sm:w-auto">
                        🔁 Reset
                    </button>
                    <button id="finishButton" disabled
                        class="bg-[#BF3131] text-white border border-transparent py-2 px-3 sm:py-2.5 sm:px-4 text-sm sm:text-base font-semibold rounded-xl cursor-not-allowed transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg w-full sm:w-auto opacity-50">
                        Selesai
                    </button>
                </div>
            </div>
        </div>

        <div id="timer" class="text-3xl font-bold text-gray-700 mt-4"></div>
    </div>

    <div id="uploadModal"
        class="hidden fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center">
        <div
            class="bg-[#FEF3E2] mx-auto w-4/5 max-w-[600px] rounded-3xl shadow-lg p-8 relative flex flex-col items-center animate-[modalFadeIn_0.4s]">
            <button
                class="upload-modal-close absolute top-4 right-4 text-3xl font-bold text-gray-400 bg-transparent border-none cursor-pointer hover:text-black">×</button>
            <h2 class="text-2xl mb-5 text-gray-800 font-bold">Select Photo Slot</h2>
            <p class="mb-5 text-gray-600">Choose which slot to place your uploaded photo:</p>
            <div class="flex gap-4 justify-center mb-6">
                <button
                    class="slot-select-button bg-[#BF3131] text-white border-none py-3 px-6 text-base font-medium rounded-xl cursor-pointer hover:bg-[#F16767] shadow-sm hover:shadow-lg"
                    data-slot="0">Slot 1</button>
                <button
                    class="slot-select-button bg-[#BF3131] text-white border-none py-3 px-6 text-base font-medium rounded-xl cursor-pointer hover:bg-[#F16767] shadow-sm hover:shadow-lg"
                    data-slot="1">Slot 2</button>
                <button
                    class="slot-select-button bg-[#BF3131] text-white border-none py-3 px-6 text-base font-medium rounded-xl cursor-pointer hover:bg-[#F16767] shadow-sm hover:shadow-lg"
                    data-slot="2">Slot 3</button>
            </div>
        </div>
    </div>

    <div id="previewModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div id="modalContent"
            class="bg-[#FEF3E2] mx-auto w-4/5 max-w-[500px] rounded-3xl shadow-lg p-8 sm:p-10 relative flex flex-col items-center transform transition-transform duration-300 ease-out">
            <div id="dragHandle" class="w-16 h-1.5 bg-gray-300 rounded-full mb-4 cursor-grab md:hidden"></div>
            <button
                class="modal-close absolute top-3 right-3 text-3xl font-bold text-gray-400 bg-transparent border-none cursor-pointer hover:text-black">×</button>
            <h2 class="text-xl mb-4 text-gray-800 font-bold">Preview Photo Strip</h2>
            <div class="w-full flex justify-center mb-6">
                <div class="w-[160px] shadow-md" id="modalPhotostrip"></div>
            </div>
            <div class="flex flex-wrap gap-3 mt-3 justify-center">
                <button id="modalDownloadButton"
                    class="bg-[#BF3131] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">⬇
                    Download PNG</button>
                <!-- Hanya tampilkan tombol GIF untuk frame gratis -->
                @if ($frame->isFree())
                    <button id="modalGifButton"
                        class="bg-[#4CAF50] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#45a049] hover:scale-105 shadow-sm hover:shadow-lg">🎬
                        Create GIF</button>
                @endif
                <!-- Hanya tampilkan tombol Share untuk frame gratis -->
                @if ($frame->isFree())
                    <button id="modalShareButton"
                        class="bg-[#BF3131] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">📤
                        Share</button>
                @endif
            </div>
        </div>
    </div>
    <div id="gifLoadingModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div
            class="bg-[#FEF3E2] mx-auto w-4/5 max-w-[400px] rounded-3xl shadow-lg p-8 relative flex flex-col items-center">
            <div class="w-16 h-16 border-4 border-[#BF3131] border-t-transparent rounded-full animate-spin mb-4"></div>
            <h3 class="text-xl mb-2 text-gray-800 font-bold">Creating GIF...</h3>
            <p class="text-gray-600 text-center mb-4">Please wait while we process your photos into an animated GIF</p>
            <div id="gifProgress" class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                <div id="gifProgressBar" class="bg-[#BF3131] h-2.5 rounded-full transition-all duration-300"
                    style="width: 0%"></div>
            </div>
            <p id="gifProgressText" class="text-sm text-gray-500">Initializing...</p>
        </div>
    </div>
    <div id="testimoniModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden testimoni-modal">
        <div
            class="bg-[#FEF3E2] mx-auto w-[90%] sm:w-4/5 max-w-[500px] rounded-3xl shadow-lg p-6 sm:p-8 relative flex flex-col items-center animate-[modalFadeIn_0.4s] max-h-[90vh] overflow-y-auto">
            <button
                class="testimoni-modal-close absolute top-4 right-4 text-3xl font-bold text-gray-400 bg-transparent border-none cursor-pointer hover:text-black">×</button>

            <h2 class="text-2xl mb-4 text-gray-800 font-bold text-center">Bagaimana pengalaman Anda?</h2>
            <p class="text-gray-600 text-center mb-6">Berikan rating dan testimoni untuk membantu kami berkembang!</p>

            <div class="star-rating" id="starRating">
                <span class="star" data-rating="1">★</span>
                <span class="star" data-rating="2">★</span>
                <span class="star" data-rating="3">★</span>
                <span class="star" data-rating="4">★</span>
                <span class="star" data-rating="5">★</span>
            </div>

            <div class="emoji-selector" id="emojiSelector">
                <span class="emoji-option" data-emoji="😊">😊</span>
                <span class="emoji-option" data-emoji="😍">😍</span>
                <span class="emoji-option" data-emoji="🤩">🤩</span>
                <span class="emoji-option" data-emoji="😎">😎</span>
                <span class="emoji-option" data-emoji="🥰">🥰</span>
            </div>

            <div class="w-full">
                <input type="text" id="testimoniName" placeholder="Nama Anda *" required
                    class="w-full p-3 border-2 border-gray-300 rounded-xl mb-4 focus:border-[#BF3131] focus:outline-none transition-colors duration-200"
                    minlength="2" maxlength="50">

                <textarea id="testimoniMessage" placeholder="Ceritakan pengalaman Anda menggunakan photo booth ini... *"
                    rows="4" required minlength="10" maxlength="500"
                    class="w-full p-3 border-2 border-gray-300 rounded-xl mb-4 focus:border-[#BF3131] focus:outline-none resize-none transition-colors duration-200"></textarea>

                <div class="text-right text-xs text-gray-500 -mt-3 mb-4">
                    <span id="messageCounter">0/500</span>
                </div>
            </div>

            <div class="flex gap-3 mt-4 justify-center w-full">
                <button id="skipTestimoni"
                    class="bg-gray-500 text-white border-none py-2.5 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-600 hover:scale-105 shadow-sm hover:shadow-lg">
                    Lewati
                </button>
                <button id="submitTestimoni"
                    class="bg-[#BF3131] text-white border-none py-2.5 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">
                    Kirim Testimoni
                </button>
            </div>
        </div>
    </div>
    <div id="retakeModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div id="retakeModalContent"
            class="mx-auto w-11/12 max-w-[450px] rounded-3xl shadow-xl p-6 sm:p-8 relative flex flex-col items-center">
            <button
                class="retake-modal-close absolute top-4 right-4 text-2xl font-bold text-gray-500 bg-transparent border-none cursor-pointer hover:text-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#BF3131] rounded-full w-8 h-8 flex items-center justify-center">&times;</button>
            <h2 class="text-2xl sm:text-3xl mb-3 text-gray-800 font-semibold text-center">Retake Your Photo?</h2>
            <p class="text-gray-600 text-base sm:text-lg text-center mb-6 px-2">This will replace your current photo
                with a new one. Are you sure?</p>
            <div class="flex gap-4 justify-center w-full">
                <button id="cancelRetakeButton"
                    class="bg-gray-600 text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-700 hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </button>
                <button id="confirmRetakeButton"
                    class="retake-button-icon bg-[#BF3131] text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#BF3131]">
                    Retake
                </button>
            </div>
        </div>
    </div>
    <div id="resetModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div id="resetModalContent"
            class="mx-auto w-11/12 max-w-[450px] rounded-3xl shadow-xl p-6 sm:p-8 relative flex flex-col items-center">
            <button
                class="reset-modal-close absolute top-4 right-4 text-2xl font-bold text-gray-500 bg-transparent border-none cursor-pointer hover:text-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#BF3131] rounded-full w-8 h-8 flex items-center justify-center">×</button>
            <h2 class="text-2xl sm:text-3xl mb-3 text-gray-800 font-semibold text-center">Reset All Photos?</h2>
            <p class="text-gray-600 text-base sm:text-lg text-center mb-6 px-2">This will clear all photos in the
                slots. This action cannot be undone.</p>
            <div class="flex gap-4 justify-center w-full">
                <button id="cancelResetButton"
                    class="bg-gray-600 text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-700 hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </button>
                <button id="confirmResetButton"
                    class="reset-button-icon bg-[#BF3131] text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#BF3131]">
                    Reset
                </button>
            </div>
        </div>
    </div>
    <div id="exitConfirmationModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div id="exitConfirmationModalContent"
            class="mx-auto w-11/12 max-w-[450px] rounded-3xl shadow-xl p-6 sm:p-8 relative flex flex-col items-center bg-[#FEF3E2]">
            <button
                class="exit-modal-close absolute top-4 right-4 text-2xl font-bold text-gray-500 bg-transparent border-none cursor-pointer hover:text-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#BF3131] rounded-full w-8 h-8 flex items-center justify-center">×</button>
            <div class="w-16 h-16 mb-4 rounded-full bg-[#BF3131] flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl mb-3 text-gray-800 font-semibold text-center">Konfirmasi Keluar</h2>
            <p class="text-gray-600 text-base sm:text-lg text-center mb-6 px-2">Anda telah mendownload foto. Apakah
                Anda yakin ingin kembali ke menu utama?</p>
            <div class="flex gap-4 justify-center w-full">
                <button id="cancelExitButton"
                    class="bg-gray-600 text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-700 hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Batal
                </button>
                <button id="confirmExitButton"
                    class="bg-[#BF3131] text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#BF3131]">
                    Kembali ke Menu
                </button>
            </div>
        </div>
    </div>
    <div id="sessionEndModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div id="sessionEndModalContent"
            class="mx-auto w-11/12 max-w-[450px] rounded-3xl shadow-xl p-6 sm:p-8 relative flex flex-col items-center bg-[#FEF3E2]">

            <div
                class="session-end-modal-close w-16 h-16 mb-4 rounded-full bg-[#BF3131] flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl mb-3 text-gray-800 font-semibold text-center">Sesi Selesai</h2>
            <p class="text-gray-600 text-base sm:text-lg text-center mb-6 px-2">Sesi Anda telah selesai karena foto
                sudah didownload.</p>
            <div class="flex gap-4 justify-center w-full">
                <button id="confirmSessionEndButton"
                    class="bg-[#BF3131] text-white border-none py-3 px-6 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#BF3131]">
                    Kembali ke Menu
                </button>
            </div>
        </div>
    </div>
    <div id="welcomeModal"
        class="fixed z-50 left-0 top-0 w-full h-full bg-black bg-opacity-70 overflow-auto justify-center items-center hidden">
        <div
            class="bg-[#FEF3E2] mx-auto w-[60%] sm:w-4/5  rounded-3xl shadow-lg p-6 sm:p-8 relative flex flex-col items-center welcome-modal">
            <button
                class="welcome-modal-close absolute top-4 right-4 text-2xl font-bold text-gray-400 bg-transparent border-none cursor-pointer hover:text-black">×</button>

            <div class="welcome-step active flex flex-col items-center">
                <h2 class="text-2xl mb-4 text-gray-800 font-bold text-center">Langkah 1: Ambil Foto</h2>
                <img src="{{ asset('step1.jpg') }}" alt="Step 1" class="w-full max-w-[1000px] rounded-lg mb-6">
            </div>
            <div class="welcome-step flex flex-col items-center">
                <h2 class="text-2xl mb-4 text-gray-800 font-bold text-center">Langkah 2: Fitur Setting Kamera</h2>
                <img src="{{ asset('step2.jpg') }}" alt="Step 2" class="w-full max-w-[1000px] rounded-lg mb-6">
            </div>
            <div class="welcome-step flex flex-col items-center">
                <h2 class="text-2xl mb-4 text-gray-800 font-bold text-center">Langkah 3: Sesuaikan Foto</h2>
                <img src="{{ asset('step3.jpg') }}" alt="Step 3" class="w-full max-w-[1000px] rounded-lg mb-6">
            </div>
            <div class="welcome-step flex flex-col items-center">
                <h2 class="text-2xl mb-4 text-gray-800 font-bold text-center">Langkah 4: Reset dan Unduh</h2>
                <img src="{{ asset('step4.jpg') }}" alt="Step 3" class="w-full max-w-[1000px] rounded-lg mb-6">
            </div>
            <div class="flex justify-center mb-4">
                <div class="step-indicator active"></div>
                <div class="step-indicator"></div>
                <div class="step-indicator"></div>
                <div class="step-indicator"></div>
            </div>
            <div class="flex gap-4 justify-center w-full">
                <button id="welcomePrevButton"
                    class="bg-gray-500 text-white border-none py-2.5 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-600 hover:scale-105 shadow-sm hover:shadow-lg hidden">
                    Sebelumnya
                </button>
                <button id="welcomeNextButton"
                    class="bg-[#BF3131] text-white border-none py-2.5 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">
                    Selanjutnya
                </button>
                <button id="welcomeFinishButton"
                    class="bg-[#BF3131] text-white border-none py-2.5 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg hidden">
                    Mulai
                </button>
            </div>
        </div>
    </div>
    <div id="recropModal"
        class="hidden fixed z-[100] inset-0 bg-black bg-opacity-70 flex justify-center items-center">
        <div id="recropModalContent" class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Recrop Your Photo</h3>
            <div id="recropImageContainer" class="w-full h-64 mb-4 bg-gray-100">
                <img id="recropImage" src="" alt="Photo to recrop" class="max-w-full max-h-full">
            </div>
            <div id="recropControls" class="space-y-4">

                <div class="flex justify-end space-x-2">
                    <button id="recropCancelBtn" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                    <button id="recropConfirmBtn" class="px-4 py-2 bg-blue-500 text-white rounded">Crop & Use
                        Photo</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan ini di bagian modal lainnya -->
    <div id="cropModal" class="hidden fixed z-[100] inset-0 bg-black bg-opacity-70 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
            <h3 class="text-xl font-bold mb-4">Crop Your Photo</h3>
            <div class="w-full h-96 mb-4 bg-gray-100">
                <img id="cropImage" src="" alt="Photo to crop" class="max-w-full max-h-full">
            </div>
            <div class="flex justify-end space-x-2">
                <button id="cropCancelBtn" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button id="cropConfirmBtn" class="px-4 py-2 bg-blue-500 text-white rounded">Crop & Use Photo</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="frameId" value="{{ $frame->id }}">
    <input type="hidden" id="frameIsPaid" value="{{ $frame->isFree() ? 'false' : 'true' }}">

    <style>
        .recrop-button {
            position: absolute;
            top: 45px;
            right: 30px;
            background-color: transparent;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 50%;
            font-size: 40px;
            cursor: pointer;
            z-index: 30;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        [data-has-photo="true"] .recrop-button {
            display: flex !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        [data-has-photo="true"]:hover .recrop-button {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            pointer-events: auto;
        }

        [data-has-photo="false"] .recrop-button {
            display: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* Modal untuk recrop */
        #recropModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            /* Pastikan lebih tinggi dari elemen lain */
            display: none;
            /* Awalnya tersembunyi */
            justify-content: center;
            align-items: center;
        }

        #recropModalContent {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        #recropImageContainer {
            width: 100%;
            height: 300px;
            margin: 15px 0;
            position: relative;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        #recropImage {
            max-width: 100%;
            max-height: 100%;
            display: block;
            /* Pertahankan efek mirror jika ada */
            transform: none !important;
        }

        #recropControls {
            margin: 15px 0;
        }

        #recropRatioSelect {
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 10px;
            width: 100%;
        }

        .recrop-btn {
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        #recropCancelBtn {
            background-color: #BF3131;
            color: white;
        }

        #recropConfirmBtn {
            background-color: #4CAF50;
            color: white;
        }

        .custom-alert {
            animation: slideInDown 0.4s ease-out;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @keyframes slideInDown {
            from {
                transform: translateX(-50%) translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        .in-modal-notification {
            animation: slideInDown 0.3s ease-out;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
                transform: translate3d(0, -30px, 0);
            }

            70% {
                transform: translate3d(0, -15px, 0);
            }

            90% {
                transform: translate3d(0, -4px, 0);
            }
        }

        /* Enhanced modal backdrop to ensure alerts are visible */
        .testimoni-modal {
            z-index: 50;
        }

        .custom-alert {
            z-index: 70 !important;
        }

        .welcome-modal {
            animation: modalFadeIn 0.4s ease-out;
            width: 80%;
            overflow-y: auto;
        }

        .welcome-step {
            display: none;
        }

        .welcome-step.active {
            display: flex;
        }

        .step-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #d1d5db;
            margin: 0 4px;
        }

        .step-indicator.active {
            background-color: #BF3131;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Session End Modal Styles */
        #sessionEndModal {
            backdrop-filter: blur(8px);
            transition: all 0.3s ease-in-out;
        }

        #sessionEndModalContent {
            background: linear-gradient(135deg, #FEF3E2 0%, #FFF7ED 100%);
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: modalScaleIn 0.4s ease-out;
        }

        @media (max-width: 768px) {
            #sessionEndModal {
                align-items: flex-end;
            }

            #sessionEndModalContent {
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 1.5rem 1.5rem 0 0;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: auto;
                max-height: 85vh;
                padding: 1.5rem 1.25rem;
                padding-bottom: calc(1.5rem + env(safe-area-inset-bottom, 16px));
                animation: modalSlideUp 0.4s ease-out;
            }
        }

        @media (min-width: 769px) {
            #sessionEndModalContent {
                animation: modalScaleIn 0.4s ease-out;
            }
        }

        #sessionEndModal.modal-closing {
            animation: modalScaleOut 0.3s ease-out;
        }

        /* Exit Confirmation Modal Styles */
        #exitConfirmationModal {
            backdrop-filter: blur(8px);
            transition: all 0.3s ease-in-out;
        }

        #exitConfirmationModalContent {
            background: linear-gradient(135deg, #FEF3E2 0%, #FFF7ED 100%);
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: modalScaleIn 0.4s ease-out;
        }

        @media (max-width: 768px) {
            #exitConfirmationModal {
                align-items: flex-end;
            }

            #exitConfirmationModalContent {
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 1.5rem 1.5rem 0 0;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: auto;
                max-height: 85vh;
                padding: 1.5rem 1.25rem;
                padding-bottom: calc(1.5rem + env(safe-area-inset-bottom, 16px));
                animation: modalSlideUp 0.4s ease-out;
            }
        }

        @media (min-width: 769px) {
            #exitConfirmationModalContent {
                animation: modalScaleIn 0.4s ease-out;
            }
        }

        #exitConfirmationModal.modal-closing {
            animation: modalScaleOut 0.3s ease-out;
        }

        /* Animasi untuk modal */
        @keyframes modalScaleIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes modalSlideUp {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* Styling Modal */
        #retakeModal {
            backdrop-filter: blur(8px);
            transition: all 0.3s ease-in-out;
        }

        #retakeModalContent {
            background: linear-gradient(135deg, #FEF3E2 0%, #FFF7ED 100%);
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Tombol dengan ikon */
        .retake-button-icon::before {
            content: '\1F4F7';
            /* Ikon kamera Unicode */
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            #retakeModal {
                align-items: flex-end;
            }

            #retakeModalContent {
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 1.5rem 1.5rem 0 0;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: auto;
                max-height: 85vh;
                padding: 1.5rem 1.25rem;
                padding-bottom: calc(1.5rem + env(safe-area-inset-bottom, 16px));
                animation: modalSlideUp 0.4s ease-out;
            }
        }

        @media (min-width: 769px) {
            #retakeModalContent {
                animation: modalScaleIn 0.4s ease-out;
            }
        }

        /* Animasi closing */
        .modal-closing {
            animation: modalScaleOut 0.3s ease-out;
        }

        @keyframes modalScaleOut {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }

        #resetModal {
            backdrop-filter: blur(8px);
            transition: all 0.3s ease-in-out;
        }

        #resetModalContent {
            background: linear-gradient(135deg, #FEF3E2 0%, #FFF7ED 100%);
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Tombol dengan ikon */
        .reset-button-icon::before {
            content: '\1F5D1';
            /* Ikon tempat sampah Unicode untuk reset */
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            #resetModal {
                align-items: flex-end;
            }

            #resetModalContent {
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 1.5rem 1.5rem 0 0;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: auto;
                max-height: 85vh;
                padding: 1.5rem 1.25rem;
                padding-bottom: calc(1.5rem + env(safe-area-inset-bottom, 16px));
                animation: modalSlideUp 0.4s ease-out;
            }
        }

        @media (min-width: 769px) {
            #resetModalContent {
                animation: modalScaleIn 0.4s ease-out;
            }
        }

        /* Animasi closing */
        .modal-closing {
            animation: modalScaleOut 0.3s ease-out;
        }

        .watermark {
            position: absolute;
            pointer-events: none !important;
            z-index: 20;
            /* Agar watermark tidak mengganggu interaksi */
            opacity: 0.4;
            /* Sesuaikan opacity sesuai kebutuhan */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watermark img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(100%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-dragging {
            transition: transform 0.1s ease-out !important;
        }

        .modal-closing {
            transform: translateY(100%) !important;
            opacity: 0 !important;
            transition: transform 0.3s ease-out, opacity 0.3s ease-out !important;
        }

        .cropper-container {
            z-index: 1000 !important;
        }

        .cropper-modal {
            background-color: transparent !important;
        }

        @media (max-width: 768px) {
            #modalContent {
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 20px 20px 0 0;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: auto;
                max-height: 85vh;
                overflow-y: auto;
                animation: modalSlideUp 0.4s;
                padding: 2rem 1.5rem 2rem 1.5rem;
                padding-bottom: calc(2rem + env(safe-area-inset-bottom, 16px));
            }

            #previewModal {
                align-items: flex-end;
            }

            #uploadModal>div {
                padding: 2rem 1.5rem;
                padding-bottom: calc(2rem + env(safe-area-inset-bottom, 16px));
            }
        }

        @media (min-width: 769px) {
            #modalContent {
                animation: modalFadeIn 0.4s;
            }
        }

        @media (max-width: 640px) {

            #filterSelect,
            #countdownSelect,
            #mirrorToggle,
            #cameraToggle,
            #resetButton,
            #finishButton {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        @media (min-width: 640px) {

            #filterSelect,
            #countdownSelect,
            #mirrorToggle,
            #cameraToggle,
            #resetButton,
            #finishButton {
                min-width: 120px;
            }
        }

        .w-full.sm\:w-auto {
            width: 100%;
        }

        @media (min-width: 640px) {
            .w-full.sm\:w-auto {
                width: auto;
            }
        }



        #countdownSelect {
            min-width: 120px;
        }

        .photo-slot-container {
            position: absolute;
            overflow: hidden;
            width: 150px;
            /* Display size, adjust as needed */
            height: 150px;
            /* Display size, adjust as needed */
        }

        .photo-slot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            image-rendering: -webkit-optimize-contrast;
            /* Improve rendering quality */
            image-rendering: crisp-edges;
            /* Ensure sharp edges */
        }

        .photo-slot {
            width: 100%;
            height: 100%;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .photo-slot img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Memastikan foto tidak stretch, hanya crop */
            object-position: center;
            /* Crop dari tengah */
        }



        .photo-slot-container:hover .retake-button {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        .retake-button {
            position: absolute;
            top: 45px;
            right: 70px;
            background-color: transparent;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 50%;
            font-size: 40px;
            cursor: pointer;
            z-index: 30;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        [data-has-photo="true"] .retake-button {
            display: flex !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        [data-has-photo="true"]:hover .retake-button {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            pointer-events: auto;
        }

        [data-has-photo="false"] .retake-button {
            display: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }


        .photo-slot img:not([src]),
        .photo-slot img[src=""],
        .photo-slot img[src*="undefined"] {
            display: none;
        }

        [data-has-photo="true"]:hover .photo-slot::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            pointer-events: none;
            z-index: 20;
        }

        [data-has-photo="true"]:hover .photo-slot::before {
            content: "Click to retake photo";
            position: absolute;
            top: -35px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 40;
            white-space: nowrap;
            pointer-events: none;
        }

        [data-has-photo="true"]:hover .retake-button {
            z-index: 35;
        }

        .retake-button:hover {
            background-color: transparent;
            transform: scale(1.1);
        }

        [data-photo-index]:hover img {
            filter: blur(2px);
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        #video {
            width: 100%;
            height: 100%;
            background: gray-200;
            rounded-xl;
            shadow-md;
            object-cover;
            transform: scaleX(-1);
            /* Remove scale-x-[-1] */
        }

        @media (max-width: 768px) {
            #video {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

        .floating-settings-toggle {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 40;
            width: 48px;
            height: 48px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .floating-settings-toggle i {
            font-size: 24px;
            color: white;
        }

        .floating-settings-toggle:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        .floating-settings-toggle.active {
            background: rgba(191, 49, 49, 0.6);
        }

        .frame-container {
            align-self: center;
        }

        .frame-container .photo-slot img {
            object-fit: cover;
            object-position: center;
        }

        @media (max-width: 767px) {
            .frame-container {
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (min-width: 768px) {
            .frame-container {
                align-self: start;
                margin-top: 0 !important;
            }
        }

        .star-rating {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin: 20px 0;
        }

        .star {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star:hover,
        .star.active {
            color: #ffd700;
        }

        .star:hover~.star {
            color: #ddd;
        }

        .testimoni-modal {
            backdrop-filter: blur(5px);
        }

        .error-input {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 1px #ef4444 !important;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .valid-input {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 1px #10b981 !important;
        }

        .required-selection {
            position: relative;
        }

        .required-selection::after {
            content: " *";
            color: #ef4444;
            font-weight: bold;
        }

        .star-rating {
            display: flex;
            gap: 5px;
            margin: 20px 0;
            justify-content: center;
        }

        .star {
            font-size: 2rem;
            color: #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 5px;
        }

        .star:hover,
        .star.active {
            color: #fbbf24;
            transform: scale(1.1);
        }

        .emoji-selector {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            justify-content: center;
        }

        .emoji-option {
            font-size: 2rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .emoji-option:hover,
        .emoji-option.selected {
            opacity: 1;
            transform: scale(1.2);
            background-color: rgba(191, 49, 49, 0.1);
        }

        #modalPhotostrip {
            width: 160px;
            /* Fixed width as per design */
            height: auto;
            /* Allow height to adjust */
            overflow: hidden;
            /* Prevent overflow */
            position: relative;
        }

        #modalPhotostrip img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Crop to fit, no stretching */
            object-position: center;
            /* Center the crop */
            display: block;
            /* Remove inline-block spacing */
        }

        @media (max-width: 768px) {
            .photo-slot-container {
                width: 120px;
                height: 120px;
            }

            .photo-slot img {
                object-fit: cover;
                object-position: center;
            }
        }

        .photo-overlay {
            transition: opacity 0.3s ease;
        }

        .photo-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Pastikan foto yang sudah loaded memiliki z-index tertinggi */
        #photo1[data-loaded="true"],
        #photo2[data-loaded="true"],
        #photo3[data-loaded="true"] {
            position: relative !important;
            z-index: 25 !important;

        }

        /* Floating Settings Toggle */
        .floating-settings-toggle {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 40;
            width: 48px;
            height: 48px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .floating-settings-toggle i {
            font-size: 24px;
            color: white;
        }

        .floating-settings-toggle:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        .floating-settings-toggle.active {
            background: rgba(191, 49, 49, 0.6);
        }

        /* Floating Options Container */
        .floating-options {
            position: absolute;
            top: 70px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .floating-options.hidden {
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
        }

        .floating-options:not(.hidden) {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* General Floating Option Styles */
        .floating-option {
            width: 48px;
            height: 48px;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .floating-option svg,
        .floating-option i {
            width: 24px;
            height: 24px;
            color: white;
        }

        .floating-option:hover {
            background: rgba(0, 0, 0, 0.6);
            transform: scale(1.1);
        }

        .floating-option.active {
            background: rgba(191, 49, 49, 0.6);
        }

        /* Specific Floating Option Styles */
        .floating-camera-toggle {
            display: flex;
        }

        @media (min-width: 769px) {
            .floating-camera-toggle {
                display: none;
            }
        }

        .floating-countdown-toggle .countdown-text {
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        /* Flash Overlay */
        #flash-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            opacity: 0;
            pointer-events: none;
            transition: opacity 1s ease;
        }

        #flash-overlay.active {
            opacity: 1;
        }

        #cropModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: none;
            justify-content: center;
            align-items: center;
        }

        #cropModal>div {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }

        #cropImage {
            max-width: 100%;
            max-height: 400px;
            display: block;
            margin: 0 auto;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        let cropper = null;
        let currentRecropIndex = null;
        let originalImageData = null;
        let originalPhotos = {}; // Untuk menyimpan foto asli sebelum di-crop
        let currentCroppedImages = {}; // Untuk menyimpan foto yang sudah di-crop
        let originalCapturedPhotos = {}; // Untuk menyimpan foto asli dari kamera sebelum di-crop
        let cropSlotIndex = null;
        let photoSlots = document.querySelectorAll('#photo1, #photo2, #photo3');
        let video = document.getElementById('video');
        let captureButton = document.getElementById('captureButton');
        let uploadButton = document.getElementById('uploadButton');
        let fileInput = document.getElementById('fileInput');
        let finishButton = document.getElementById('finishButton');
        let filterSelect = document.getElementById('filterSelect');
        let timerDisplay = document.getElementById('timer');
        let countdownOverlay = document.getElementById('countdown-overlay');
        let canvas = document.createElement('canvas');
        let ctx = canvas.getContext('2d');

        let retakeButtons = document.querySelectorAll('.retake-button');
        let frameId = document.getElementById('frameId').value;

        let modal = document.getElementById('previewModal');
        let modalClose = document.querySelector('.modal-close');
        let modalPhotostrip = document.getElementById('modalPhotostrip');
        let resetButton = document.getElementById('resetButton');
        let modalDownloadButton = document.getElementById('modalDownloadButton');
        let modalShareButton = document.getElementById('modalShareButton');

        let uploadModal = document.getElementById('uploadModal');
        let slotSelectButtons = document.querySelectorAll('.slot-select-button');
        let uploadModalClose = document.querySelector('.upload-modal-close');
        let testimoniModal = document.getElementById('testimoniModal');
        let testimoniModalClose = document.querySelector('.testimoni-modal-close');
        let starRating = document.getElementById('starRating');
        let emojiSelector = document.getElementById('emojiSelector');
        let testimoniName = document.getElementById('testimoniName');
        let testimoniMessage = document.getElementById('testimoniMessage');
        let submitTestimoni = document.getElementById('submitTestimoni');
        let skipTestimoni = document.getElementById('skipTestimoni');

        let modalGifButton = document.getElementById('modalGifButton');
        let gifLoadingModal = document.getElementById('gifLoadingModal');
        let gifProgressBar = document.getElementById('gifProgressBar');
        let gifProgressText = document.getElementById('gifProgressText');
        const flashOverlay = document.getElementById('flash-overlay');
        let generatedGifBlob = null;
        let isFlashEnabled = false;
        let hasShownSessionEndAlert = false;
        let isSettingsOpen = false;
        let currentWelcomeStep = 0;
        const totalWelcomeSteps = 4;

        let hasShownTestimoniModal = false;
        let currentPhotoIndex = null;
        let countdown = 3;
        let timer;
        let capturing = false;
        let photoStripImage = null;
        let selectedFile = null;
        let selectedSlotIndex = null;
        let isInitialized = false;
        let selectedRating = 0;
        let selectedEmoji = '';

        let isMirrored = false;
        let selectedCountdown = 3;
        const countdownOptions = [3, 5, 0]; // Available countdown options
        let currentCountdownIndex = 0; // Track current countdown option
        let currentCaptureSlot = 0;
        const totalSlots = 3;
        let currentFacingMode = 'user';
        let currentStream = null;


        // Konfigurasi untuk single session
        const SINGLE_SESSION_CONFIG = {
            storageKey: 'activeBoothSession',
            heartbeatInterval: 2000, // 2 detik
            sessionTimeout: 10000, // 10 detik timeout
            maxRetries: 3
        };

        let heartbeatInterval = null;
        let isActiveSession = false;
        let sessionId = null;

        // Fungsi untuk generate unique session ID
        function generateSessionId() {
            return Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        }

        // Fungsi untuk mendapatkan data pembayaran
        function getPaymentData() {
            try {
                const pendingPaymentLS = localStorage.getItem('pendingPayment');
                return JSON.parse(pendingPaymentLS || '{}');
            } catch (error) {
                return {};
            }
        }

        // Fungsi untuk membuat unique key berdasarkan payment data
        function createSessionKey(paymentData) {
            if (!paymentData.order_id || !paymentData.frame_id) {
                return null;
            }
            return `${SINGLE_SESSION_CONFIG.storageKey}_${paymentData.order_id}_${paymentData.frame_id}`;
        }

        // Fungsi untuk cek apakah sudah ada session aktif
        function checkActiveSession() {
            const paymentData = getPaymentData();
            const sessionKey = createSessionKey(paymentData);

            if (!sessionKey) {
                console.warn('Cannot create session key - invalid payment data');
                return false;
            }

            try {
                const activeSession = localStorage.getItem(sessionKey);

                if (!activeSession) {
                    return false; // Tidak ada session aktif
                }

                const sessionData = JSON.parse(activeSession);
                const currentTime = Date.now();

                // Cek apakah session masih valid (tidak timeout)
                if (currentTime - sessionData.lastHeartbeat > SINGLE_SESSION_CONFIG.sessionTimeout) {
                    console.log('Previous session expired, cleaning up');
                    localStorage.removeItem(sessionKey);
                    return false;
                }

                // Cek apakah ini session yang sama (tab yang sama)
                if (sessionData.sessionId === sessionId) {
                    return false; // Ini adalah session kita sendiri
                }

                console.warn('Another active session found:', sessionData);
                return true; // Ada session lain yang aktif

            } catch (error) {
                console.error('Error checking active session:', error);
                return false;
            }
        }

        // Fungsi untuk membuat session baru
        function createNewSession() {
            const paymentData = getPaymentData();
            const sessionKey = createSessionKey(paymentData);

            if (!sessionKey) {
                return false;
            }

            sessionId = generateSessionId();

            const sessionData = {
                sessionId: sessionId,
                orderId: paymentData.order_id,
                frameId: paymentData.frame_id,
                startTime: Date.now(),
                lastHeartbeat: Date.now(),
                userAgent: navigator.userAgent.substring(0, 100) // Potong untuk menghemat space
            };

            try {
                localStorage.setItem(sessionKey, JSON.stringify(sessionData));
                isActiveSession = true;
                console.log('New session created:', sessionId);
                return true;
            } catch (error) {
                console.error('Error creating session:', error);
                return false;
            }
        }

        // Fungsi untuk update heartbeat session
        function updateSessionHeartbeat() {
            if (!isActiveSession || !sessionId) {
                return;
            }

            const paymentData = getPaymentData();
            const sessionKey = createSessionKey(paymentData);

            if (!sessionKey) {
                return;
            }

            try {
                const activeSession = localStorage.getItem(sessionKey);
                if (activeSession) {
                    const sessionData = JSON.parse(activeSession);

                    // Pastikan ini adalah session kita
                    if (sessionData.sessionId === sessionId) {
                        sessionData.lastHeartbeat = Date.now();
                        localStorage.setItem(sessionKey, JSON.stringify(sessionData));
                    } else {
                        // Session kita sudah digantikan oleh session lain
                        console.warn('Our session has been replaced');
                        handleSessionTakeover();
                    }
                }
            } catch (error) {
                console.error('Error updating heartbeat:', error);
            }
        }

        // Fungsi untuk menangani ketika session diambil alih
        function handleSessionTakeover() {
            stopHeartbeat();
            isActiveSession = false;

            showSessionTakeoverAlert();
        }

        // Fungsi untuk menampilkan alert session takeover
        function showSessionTakeoverAlert() {
            const alertHtml = `
        <div id="sessionTakeoverAlert" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 text-center">
                <div class="mb-4">
                    <svg class="w-16 h-16 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Session Diambil Alih</h3>
                <p class="text-gray-600 mb-4">Halaman ini sudah dibuka di tab/browser lain. Hanya satu session yang diizinkan.</p>
                <button onclick="redirectToMainMenu()" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Kembali ke Menu Utama
                </button>
            </div>
        </div>
    `;

            document.body.insertAdjacentHTML('beforeend', alertHtml);
        }

        // Fungsi untuk memulai heartbeat
        function startHeartbeat() {
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
            }

            heartbeatInterval = setInterval(() => {
                updateSessionHeartbeat();

                // Cek apakah ada session lain yang mengambil alih
                if (checkActiveSession()) {
                    handleSessionTakeover();
                }
            }, SINGLE_SESSION_CONFIG.heartbeatInterval);

            console.log('Heartbeat started');
        }

        // Fungsi untuk menghentikan heartbeat
        function stopHeartbeat() {
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
                heartbeatInterval = null;
                console.log('Heartbeat stopped');
            }
        }

        // Fungsi untuk cleanup session saat halaman ditutup
        function cleanupSession() {
            if (!isActiveSession || !sessionId) {
                return;
            }

            const paymentData = getPaymentData();
            const sessionKey = createSessionKey(paymentData);

            if (sessionKey) {
                try {
                    const activeSession = localStorage.getItem(sessionKey);
                    if (activeSession) {
                        const sessionData = JSON.parse(activeSession);

                        // Hanya hapus jika ini adalah session kita
                        if (sessionData.sessionId === sessionId) {
                            localStorage.removeItem(sessionKey);
                            console.log('Session cleaned up');
                        }
                    }
                } catch (error) {
                    console.error('Error cleaning up session:', error);
                }
            }

            stopHeartbeat();
            isActiveSession = false;
        }

        // Fungsi utama untuk validasi single session
        function validateSingleSession() {
            console.log('Validating single session access...');

            // Cek apakah frame berbayar
            const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';

            // Jika frame gratis, skip validasi session
            if (!frameIsPaid) {
                console.log('Frame is free - skipping single session validation');
                return true;
            }

            // Cek apakah sudah ada session aktif (hanya untuk frame berbayar)
            if (checkActiveSession()) {
                console.warn('Another session is already active');
                showActiveSessionAlert();
                return false;
            }

            // Buat session baru (hanya untuk frame berbayar)
            if (!createNewSession()) {
                console.error('Failed to create new session');
                return false;
            }

            // Mulai heartbeat (hanya untuk frame berbayar)
            startHeartbeat();

            console.log('Single session validation passed');
            return true;
        }
        // Fungsi untuk menampilkan alert session sudah aktif
        function showActiveSessionAlert() {
            const alertHtml = `
        <div id="activeSessionAlert" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 text-center">
                <div class="mb-4">
                    <svg class="w-16 h-16 mx-auto text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Session Sudah Aktif</h3>
                <p class="text-gray-600 mb-4">Halaman ini sudah dibuka di tab/browser lain. Tutup tab lain terlebih dahulu atau tunggu beberapa saat.</p>
                <div class="flex gap-3 justify-center">
                    <button onclick="redirectToMainMenu()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                        Kembali ke Menu
                    </button>
                    <button onclick="forceNewSession()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Paksa Buka
                    </button>
                </div>
            </div>
        </div>
    `;

            document.body.insertAdjacentHTML('beforeend', alertHtml);
        }

        // Fungsi untuk memaksa membuat session baru
        function forceNewSession() {
            const paymentData = getPaymentData();
            const sessionKey = createSessionKey(paymentData);

            if (sessionKey) {
                // Hapus session yang ada
                localStorage.removeItem(sessionKey);
            }

            // Hapus alert
            const alert = document.getElementById('activeSessionAlert');
            if (alert) {
                alert.remove();
            }

            // Buat session baru
            if (createNewSession()) {
                startHeartbeat();
                location.reload(); // Reload halaman untuk melanjutkan
            }
        }

        // Fungsi untuk redirect ke menu utama
        function redirectToMainMenu() {
            cleanupSession();
            localStorage.removeItem('pendingPayment');
            window.location.href = '/';
        }

        // Event listeners untuk cleanup session
        window.addEventListener('beforeunload', cleanupSession);
        window.addEventListener('unload', cleanupSession);

        // Event listener untuk visibility change (tab switch)
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Tab tersembunyi, kurangi frekuensi heartbeat
                if (heartbeatInterval) {
                    clearInterval(heartbeatInterval);
                    heartbeatInterval = setInterval(updateSessionHeartbeat, SINGLE_SESSION_CONFIG
                        .heartbeatInterval * 2);
                }
            } else {
                // Tab aktif kembali, kembalikan frekuensi normal
                if (isActiveSession) {
                    startHeartbeat();
                }
            }
        });

        // Modifikasi fungsi initializeBoothPage yang sudah ada
        function initializeBoothPageWithSingleSession() {
            // Validasi akses booth dulu
            if (!validateBoothAccess()) {
                return;
            }

            // Validasi single session
            if (!validateSingleSession()) {
                return;
            }

            // Lanjutkan inisialisasi booth normal
            console.log('Booth initialized with single session protection');

            // Inisialisasi komponen booth lainnya
            initializeCamera();
            setupFrameDisplay();
            attachBoothEventListeners();
        }

        // Update DOMContentLoaded listener
        document.addEventListener('DOMContentLoaded', function() {
            initializeBoothPageWithSingleSession();
            setTimeout(() => {
                showWelcomeModal();
            }, 500);

            if (typeof Cropper === 'undefined') {
                const cropperScript = document.createElement('script');
                cropperScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js';
                cropperScript.onload = function() {
                    const cropperCSS = document.createElement('link');
                    cropperCSS.rel = 'stylesheet';
                    cropperCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css';
                    document.head.appendChild(cropperCSS);

                    setupRecropButtons();
                    setupRecropEventListeners();
                };
                document.head.appendChild(cropperScript);
            } else {
                setupRecropButtons();
                setupRecropEventListeners();
            }

            const frameIsPaidElement = document.getElementById('frameIsPaid');

            if (!frameIsPaidElement) {
                console.error('frameIsPaid element not found');
                return;
            }

            // Jalankan inisialisasi validasi
            if (!initializeFrameValidation()) {
                console.log('Frame validation failed');
                return;
            }

            console.log('Frame validation completed successfully');
        });

        const originalCaptureButtonHTML = captureButton ? captureButton.innerHTML : '';



        console.log('Initial elements:', {
            photoSlots: photoSlots.length,
            video: !!video,
            captureButton: !!captureButton,
            uploadButton: !!uploadButton,
            fileInput: !!fileInput,
            finishButton: !!finishButton,
            filterSelect: !!filterSelect,
            uploadModal: !!uploadModal,
            slotSelectButtons: slotSelectButtons.length
        });

        function initializeWebcam(facingMode = 'user') {
            // Stop existing stream if any
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
                currentStream = null;
                console.log('Existing stream stopped');
            }

            // Detect iOS
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) ||
                (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

            // Set video constraints with improved compatibility for iOS
            const constraints = {
                video: {
                    width: {
                        ideal: isIOS ? 1280 : 1920 // Lower resolution for iOS
                    },
                    height: {
                        ideal: isIOS ? 720 : 1080
                    },
                    aspectRatio: isIOS ? {
                        exact: 4 / 3
                    } : {
                        ideal: 4 / 3
                    }, // Strict ratio for iOS
                    facingMode: facingMode,
                    frameRate: {
                        ideal: isIOS ? 24 : 30, // Lower frame rate for iOS
                        max: isIOS ? 30 : 60
                    }
                    // Hapus zoom constraint dari sini karena bisa menyebabkan error
                },
                audio: false
            };

            // Additional iOS-specific constraints
            if (isIOS) {
                constraints.video = {
                    ...constraints.video,
                    // These options help with iOS camera selection
                    deviceId: undefined,
                    exact: undefined,
                    // Force specific modes for iOS
                    advanced: [{
                        facingMode: facingMode === 'user' ? 'user' : {
                            exact: 'environment'
                        }
                    }]
                };
            }

            navigator.mediaDevices.getUserMedia(constraints)
                .then(stream => {
                    currentStream = stream;
                    video.srcObject = stream;

                    // iOS-specific video handling
                    if (isIOS) {
                        video.setAttribute('playsinline', 'true');
                        video.setAttribute('webkit-playsinline', 'true');
                    }

                    // Setelah stream berhasil, coba set zoom level secara manual
                    const videoTrack = stream.getVideoTracks()[0];
                    if (videoTrack && videoTrack.getCapabilities) {
                        try {
                            const capabilities = videoTrack.getCapabilities();
                            console.log('Camera capabilities:', capabilities);

                            if (capabilities.zoom && capabilities.zoom.min <= 0.5 && capabilities.zoom.max >= 0.5) {
                                videoTrack.applyConstraints({
                                    zoom: 0.5
                                }).then(() => {
                                    console.log('Zoom level set to 0.5x');
                                }).catch(err => {
                                    console.log('Could not set zoom level:', err);
                                });
                            } else {
                                console.log('Zoom 0.5x not supported by this camera');
                                // Coba dengan zoom yang didukung
                                if (capabilities.zoom) {
                                    const minZoom = capabilities.zoom.min;
                                    const maxZoom = capabilities.zoom.max;
                                    const targetZoom = Math.max(minZoom, Math.min(0.5, maxZoom));

                                    videoTrack.applyConstraints({
                                        zoom: targetZoom
                                    }).then(() => {
                                        console.log(`Zoom level set to ${targetZoom}x (closest to 0.5x)`);
                                    }).catch(err => {
                                        console.log('Could not set any zoom level:', err);
                                    });
                                }
                            }
                        } catch (err) {
                            console.log('Error getting camera capabilities:', err);
                        }
                    } else {
                        console.log('Camera zoom not supported on this device');
                    }

                    video.play().catch(err => {
                        console.error('Video play failed:', err);
                        // iOS fallback - try again with simpler constraints
                        if (isIOS) {
                            console.log('Trying fallback constraints for iOS');
                            initializeWebcamWithFallbackConstraints(facingMode);
                        }
                    });

                    currentFacingMode = facingMode;
                    console.log(`Webcam initialized with facingMode: ${facingMode}`);

                    // Remove scale-x-[-1] from CSS and handle mirroring via canvas
                    video.style.transform = 'none';
                    updateMirrorEffect();

                    updateFlashToggleVisibility();
                    updateFloatingCameraToggleButton();
                })
                .catch(err => {
                    console.error(`Error accessing webcam with facingMode ${facingMode}:`, err);

                    // iOS-specific error handling
                    if (isIOS && err.name === 'OverconstrainedError') {
                        console.log('Trying fallback constraints for iOS OverconstrainedError');
                        initializeWebcamWithFallbackConstraints(facingMode);
                    } else if (facingMode === 'environment' && err.name !== 'OverconstrainedError') {
                        console.log('Falling back to front camera...');
                        initializeWebcam('user');
                    } else {
                        alert('Failed to access webcam. Please ensure camera permissions are granted and retry.');
                        setTimeout(() => initializeWebcam('user', {
                            width: {
                                min: 640
                            },
                            height: {
                                min: 480
                            }
                        }), 2000);
                    }
                });
        }

        // Modified fallback function with zoom
        function initializeWebcamWithFallbackConstraints(facingMode) {
            const fallbackConstraints = {
                video: {
                    facingMode: facingMode,
                    width: {
                        min: 640,
                        ideal: 1280
                    },
                    height: {
                        min: 480,
                        ideal: 720
                    }
                    // Hapus zoom dari fallback constraints
                },
                audio: false
            };

            navigator.mediaDevices.getUserMedia(fallbackConstraints)
                .then(stream => {
                    currentStream = stream;
                    video.srcObject = stream;
                    video.setAttribute('playsinline', 'true');
                    video.setAttribute('webkit-playsinline', 'true');

                    // Set zoom level untuk fallback juga dengan penanganan error yang lebih baik
                    const videoTrack = stream.getVideoTracks()[0];
                    if (videoTrack && videoTrack.getCapabilities) {
                        try {
                            const capabilities = videoTrack.getCapabilities();
                            if (capabilities.zoom && capabilities.zoom.min <= 0.5 && capabilities.zoom.max >= 0.5) {
                                videoTrack.applyConstraints({
                                    zoom: 0.5
                                }).then(() => {
                                    console.log('Fallback: Zoom level set to 0.5x');
                                }).catch(err => {
                                    console.log('Fallback: Could not set zoom level:', err);
                                });
                            } else {
                                console.log('Fallback: Zoom 0.5x not supported');
                            }
                        } catch (err) {
                            console.log('Fallback: Error with zoom capabilities:', err);
                        }
                    }

                    video.play()
                        .then(() => {
                            console.log('iOS fallback camera working');
                            currentFacingMode = facingMode;
                            updateMirrorEffect();
                            updateFlashToggleVisibility();
                            updateFloatingCameraToggleButton();
                        })
                        .catch(err => {
                            console.error('iOS fallback video play failed:', err);
                            alert('Could not start camera on this device. Please try another browser.');
                        });
                })
                .catch(err => {
                    console.error('iOS fallback camera failed:', err);
                    alert('Camera access not available. Please check permissions and try again.');
                });
        }

        function updateMirrorEffect() {
            if (isMirrored && video) {
                video.style.transform = 'scaleX(-1)';
            } else if (video) {
                video.style.transform = 'none';
            }
        }

        function setupFilterChange() {
            if (filterSelect) {
                filterSelect.addEventListener('change', () => {
                    if (video) {
                        video.style.filter = filterSelect.value;
                    }
                });
            }
        }

        function isPhotoSlotEmpty(slot) {
            if (!slot || !slot.src) return true;
            return (
                slot.src === '' ||
                slot.src === window.location.href ||
                slot.src.includes('undefined') ||
                slot.src.length < 20
            );
        }

        function checkAllPhotosTaken() {
            // Check if all photo slots are filled
            const allFilled = Array.from(photoSlots).every(slot => !isPhotoSlotEmpty(slot));
            if (finishButton) {
                finishButton.disabled = !allFilled;
                if (allFilled) {
                    finishButton.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    finishButton.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }
            if (captureButton) {
                captureButton.disabled = allFilled;
                if (allFilled) {
                    captureButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    captureButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
            console.log('All photos taken:', allFilled);
            return allFilled;
        }

        function capturePhoto() {
            const photoSlot = photoSlots[currentPhotoIndex];
            if (!photoSlot) {
                console.error('Photo slot not found for index:', currentPhotoIndex);
                resetCaptureState();
                return;
            }

            // Detect if the device is mobile
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            // Show flash effect if enabled
            if (isFlashEnabled && flashOverlay) {
                if (isMobile && currentFacingMode === 'environment') {
                    // Attempt to use native hardware flash for mobile rear camera
                    useNativeFlash()
                        .then(() => {
                            console.log('Native flash triggered');
                            setTimeout(() => captureImage(), 100); // Small delay to ensure flash is off
                        })
                        .catch(err => {
                            console.error('Failed to trigger native flash:', err);
                            // Fallback to white overlay flash
                            triggerWhiteOverlayFlash(() => captureImage()); // Pass captureImage as callback
                        });
                } else {
                    // Use white overlay flash for desktop or front camera
                    triggerWhiteOverlayFlash(() => captureImage()); // Pass captureImage as callback
                }
            } else {
                // No flash, capture directly
                captureImage();
            }
        }

        // Modified triggerWhiteOverlayFlash to accept a callback
        function triggerWhiteOverlayFlash(callback) {
            flashOverlay.classList.add('active');
            setTimeout(() => {
                flashOverlay.classList.remove('active');
                if (callback) callback(); // Execute callback after flash
            }, 1000); // Flash duration: 1000ms (1 second)
        }

        // Helper function to capture the image
        function captureImage() {
            const slotRect = photoSlots[currentPhotoIndex].getBoundingClientRect();
            const targetAspectRatio = slotRect.width / slotRect.height;
            const videoAspectRatio = video.videoWidth / video.videoHeight;

            let sourceWidth = video.videoWidth;
            let sourceHeight = video.videoHeight;
            let sourceX = 0;
            let sourceY = 0;

            if (videoAspectRatio > targetAspectRatio) {
                sourceWidth = video.videoHeight * targetAspectRatio;
                sourceX = (video.videoWidth - sourceWidth) / 2;
            } else {
                sourceHeight = video.videoWidth / targetAspectRatio;
                sourceY = (video.videoHeight - sourceHeight) / 2;
            }

            const outputWidth = 800;
            const outputHeight = outputWidth / targetAspectRatio;

            // Canvas untuk foto hasil crop
            canvas.width = outputWidth;
            canvas.height = outputHeight;

            // Canvas untuk foto asli (dengan efek mirror dan filter)
            const originalCanvas = document.createElement('canvas');
            originalCanvas.width = video.videoWidth;
            originalCanvas.height = video.videoHeight;
            const originalCtx = originalCanvas.getContext('2d');

            // Terapkan mirror dan filter ke foto asli
            if (isMirrored) {
                originalCtx.translate(originalCanvas.width, 0);
                originalCtx.scale(-1, 1);
            }
            originalCtx.filter = getComputedStyle(video).filter;
            if (isFlashEnabled) {
                originalCtx.filter = `${originalCtx.filter} brightness(1.2)`;
            }
            originalCtx.drawImage(video, 0, 0);

            // Simpan foto asli dengan efek
            originalCapturedPhotos[currentPhotoIndex] = originalCanvas.toDataURL('image/png');

            // Proses untuk foto hasil crop
            ctx.save();
            if (isMirrored) {
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
            }
            ctx.filter = getComputedStyle(video).filter;
            if (isFlashEnabled) {
                ctx.filter = `${ctx.filter} brightness(1.2)`;
            }
            ctx.drawImage(video, sourceX, sourceY, sourceWidth, sourceHeight, 0, 0, canvas.width, canvas.height);
            ctx.restore();

            const dataUrl = canvas.toDataURL('image/png', 0.9);
            const success = setPhotoToSlot(dataUrl, currentPhotoIndex);
            if (!success) {
                console.error('Failed to set photo to slot', currentPhotoIndex);
            } else {
                console.log('Photo successfully captured and set to slot', currentPhotoIndex);
                updateRetakeButtonsState();
                checkAllPhotosTaken();
            }

            resetCaptureState();
        }

        async function useNativeFlash() {
            if (!currentStream || !isFlashEnabled) {
                return Promise.reject('No stream or flash disabled');
            }

            const videoTrack = currentStream.getVideoTracks()[0];
            if (!videoTrack) {
                return Promise.reject('No video track available');
            }

            try {
                const imageCapture = new ImageCapture(videoTrack);
                const capabilities = await videoTrack.getCapabilities();

                // Check if flash is supported
                if (capabilities.torch) {
                    // Enable torch (flash)
                    await videoTrack.applyConstraints({
                        advanced: [{
                            torch: true
                        }]
                    });

                    // Keep flash on briefly
                    return new Promise((resolve) => {
                        setTimeout(async () => {
                            // Turn off flash after 1 second
                            await videoTrack.applyConstraints({
                                advanced: [{
                                    torch: false
                                }]
                            });
                            resolve();
                        }, 1000);
                    });
                } else {
                    return Promise.reject('Flash not supported on this device');
                }
            } catch (err) {
                console.error('Error accessing native flash:', err);
                return Promise.reject(err);
            }
        }

        function resetCaptureState() {
            capturing = false;
            clearInterval(timer);

            // Update capture button will be called by setPhotoToSlot
            // This ensures the button shows the correct next slot
            updateCaptureButton();

            if (countdownOverlay) countdownOverlay.textContent = "";
        }

        function updateCaptureButton() {
            if (!captureButton) return;

            // Hitung berapa foto yang sudah diambil
            const takenPhotos = Array.from(photoSlots).filter(slot => !isPhotoSlotEmpty(slot)).length;

            // Find next empty slot
            const nextEmptySlot = findNextEmptySlot();

            if (nextEmptySlot === null) {
                // All slots filled
                captureButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5" fill="currentColor">
                <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
            </svg>
            All Photos Taken
        `;
                captureButton.disabled = true;
                captureButton.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                // Show current count and next slot to capture
                captureButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5" fill="currentColor">
                <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
            </svg>
            Capture ${takenPhotos}/${totalSlots}
        `;
                captureButton.disabled = false;
                captureButton.classList.remove('opacity-50', 'cursor-not-allowed');
                currentCaptureSlot = nextEmptySlot;
            }
        }

        function findNextEmptySlot() {
            for (let i = 0; i < photoSlots.length; i++) {
                if (isPhotoSlotEmpty(photoSlots[i])) {
                    return i;
                }
            }
            return null;
        }

        function startCountdown(photoIndex = null) {
            if (capturing) return;

            // Use provided photoIndex or current capture slot
            const targetSlot = photoIndex !== null ? photoIndex : currentCaptureSlot;

            // Validate slot
            if (targetSlot === null || targetSlot < 0 || targetSlot >= photoSlots.length) {
                console.error('Invalid slot for capture:', targetSlot);
                return;
            }

            // Check if slot is already filled
            if (!isPhotoSlotEmpty(photoSlots[targetSlot])) {
                console.log('Slot already filled, finding next empty slot');
                const nextEmpty = findNextEmptySlot();
                if (nextEmpty === null) {
                    console.log('All slots filled');
                    return;
                }
                currentPhotoIndex = nextEmpty;
            } else {
                currentPhotoIndex = targetSlot;
            }

            capturing = true;
            countdown = selectedCountdown;

            if (countdownOverlay) {
                countdownOverlay.textContent = countdown > 0 ? countdown : '';
            }

            // Update capture button
            if (captureButton) {
                const takenPhotos = Array.from(photoSlots).filter(slot => !isPhotoSlotEmpty(slot)).length;
                captureButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 animate-pulse" fill="currentColor">
                <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
            </svg>
            Capturing ${takenPhotos}/${totalSlots}...
        `;
                captureButton.disabled = true;
            }

            if (selectedCountdown === 0) {
                capturePhoto();
            } else {
                timer = setInterval(() => {
                    countdown--;
                    if (countdown > 0) {
                        if (countdownOverlay) countdownOverlay.textContent = countdown;
                    } else {
                        clearInterval(timer);
                        if (countdownOverlay) countdownOverlay.textContent = "";
                        capturePhoto();
                    }
                }, 1000);
            }
        }

        function clearPhotoSlot(index) {
            if (index < 0 || index >= photoSlots.length) return;

            const slot = photoSlots[index];
            if (slot) {
                slot.src = '';
                slot.removeAttribute('data-loaded');
                slot.style.display = 'block';
                slot.style.zIndex = '1';

                // Hapus foto asli dan hasil crop
                delete originalPhotos[index];
                delete currentCroppedImages[index];

                // Tampilkan kembali overlay
                const overlay = document.querySelector(`.photo-overlay[data-slot="${index}"]`);
                if (overlay) {
                    overlay.classList.remove('hidden');
                }

                // Update parent container
                const container = slot.closest('[data-photo-index]');
                if (container) {
                    container.setAttribute('data-has-photo', 'false');
                }

                // Update retake button state
                updateRetakeButtonsState();

                // Update capture button after photo is cleared
                updateCaptureButton();
            }
        }

        function setPhotoToSlot(dataUrl, index) {
            if (index < 0 || index >= photoSlots.length || !dataUrl) return false;

            const slot = photoSlots[index];
            if (!slot) return false;

            slot.onload = function() {
                console.log(`Photo successfully loaded in slot ${index}`);
                slot.setAttribute('data-loaded', 'true');

                // Set z-index tinggi untuk foto
                slot.style.position = 'relative';
                slot.style.zIndex = '25';

                // Sembunyikan overlay yang sesuai
                const overlay = document.querySelector(`.photo-overlay[data-slot="${index}"]`);
                if (overlay) {
                    overlay.classList.add('hidden');
                }

                // Update retake button state
                updateRetakeButtonsState();
            };

            slot.onerror = function() {
                console.error(`Failed to load photo in slot ${index}`);
                clearPhotoSlot(index);
            };

            slot.src = dataUrl;
            slot.style.display = 'block';
            slot.style.width = '100%';
            slot.style.height = '100%';
            slot.style.objectFit = 'cover';
            slot.style.objectPosition = 'center';
            slot.style.position = 'relative';
            slot.style.zIndex = '25';

            return true;
        }

        function setupRetakeButtonListeners() {
            retakeButtons.forEach(button => {
                const newButton = button.cloneNode(true);
                button.parentNode.replaceChild(newButton, button);
            });

            retakeButtons = document.querySelectorAll('.retake-button');

            retakeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    const hasPhoto = this.getAttribute('data-has-photo') === 'true';
                    if (hasPhoto && !capturing) {
                        showRetakeModal(index);
                    }
                });
            });
        }

        function showRetakeModal(index) {
            const retakeModal = document.getElementById('retakeModal');
            const confirmRetakeButton = document.getElementById('confirmRetakeButton');
            const cancelRetakeButton = document.getElementById('cancelRetakeButton');
            const retakeModalClose = document.querySelector('.retake-modal-close');

            if (retakeModal && confirmRetakeButton && cancelRetakeButton && retakeModalClose) {
                retakeModal.setAttribute('data-retake-index', index);
                retakeModal.style.display = 'flex';

                // Bersihkan event listener sebelumnya
                const newConfirmButton = confirmRetakeButton.cloneNode(true);
                confirmRetakeButton.parentNode.replaceChild(newConfirmButton, confirmRetakeButton);
                const newCancelButton = cancelRetakeButton.cloneNode(true);
                cancelRetakeButton.parentNode.replaceChild(newCancelButton, cancelRetakeButton);
                const newCloseButton = retakeModalClose.cloneNode(true);
                retakeModalClose.parentNode.replaceChild(newCloseButton, retakeModalClose);

                // Tambahkan event listener baru
                document.querySelector('#confirmRetakeButton').addEventListener('click', () => {
                    const slotIndex = parseInt(retakeModal.getAttribute('data-retake-index'));
                    clearPhotoSlot(slotIndex); // Asumsi fungsi ini ada di kode asli
                    updateRetakeButtonsState(); // Asumsi fungsi ini ada di kode asli
                    closeRetakeModal();
                });

                document.querySelector('#cancelRetakeButton').addEventListener('click', closeRetakeModal);
                document.querySelector('.retake-modal-close').addEventListener('click', closeRetakeModal);

                retakeModal.addEventListener('click', (e) => {
                    if (e.target === retakeModal) {
                        closeRetakeModal();
                    }
                }, {
                    once: true
                });

                // Fokus pada tombol Cancel untuk aksesibilitas
                document.querySelector('#cancelRetakeButton').focus();
            }
        }

        function closeRetakeModal() {
            const retakeModal = document.getElementById('retakeModal');
            const retakeModalContent = document.getElementById('retakeModalContent');
            if (retakeModal && retakeModalContent) {
                retakeModalContent.classList.add('modal-closing');
                setTimeout(() => {
                    retakeModal.style.display = 'none';
                    retakeModalContent.classList.remove('modal-closing');
                }, 300);
            }
        }

        function setupResetButtonListener() {
            if (resetButton) {
                // Clone the button to avoid duplicate event listeners
                const newButton = resetButton.cloneNode(true);
                resetButton.parentNode.replaceChild(newButton, resetButton);
                resetButton = document.getElementById('resetButton');

                resetButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Check if there are any photos in the slots
                    const hasPhotos = Array.from(photoSlots).some(slot => !isPhotoSlotEmpty(slot));
                    if (hasPhotos && !capturing) {
                        showResetModal();
                    } else {
                        console.log('No photos to reset or capture in progress');
                    }
                });
            }
        }

        function showResetModal() {
            const resetModal = document.getElementById('resetModal');
            const confirmResetButton = document.getElementById('confirmResetButton');
            const cancelResetButton = document.getElementById('cancelResetButton');
            const resetModalClose = document.querySelector('.reset-modal-close');

            if (resetModal && confirmResetButton && cancelResetButton && resetModalClose) {
                resetModal.style.display = 'flex';

                // Clone buttons to avoid duplicate event listeners
                const newConfirmButton = confirmResetButton.cloneNode(true);
                confirmResetButton.parentNode.replaceChild(newConfirmButton, confirmResetButton);
                const newCancelButton = cancelResetButton.cloneNode(true);
                cancelResetButton.parentNode.replaceChild(newCancelButton, cancelResetButton);
                const newCloseButton = resetModalClose.cloneNode(true);
                resetModalClose.parentNode.replaceChild(newCloseButton, resetModalClose);

                // Add event listeners
                document.querySelector('#confirmResetButton').addEventListener('click', () => {
                    resetPhotos(); // Call resetPhotos on confirmation
                    updateRetakeButtonsState();
                    closeResetModal();
                });

                document.querySelector('#cancelResetButton').addEventListener('click', closeResetModal);
                document.querySelector('.reset-modal-close').addEventListener('click', closeResetModal);

                resetModal.addEventListener('click', (e) => {
                    if (e.target === resetModal) {
                        closeResetModal();
                    }
                }, {
                    once: true
                });

                // Focus on Cancel button for accessibility
                document.querySelector('#cancelResetButton').focus();
            } else {
                console.error('Reset modal elements not found');
            }
        }

        function closeResetModal() {
            const resetModal = document.getElementById('resetModal');
            const resetModalContent = document.getElementById('resetModalContent');
            if (resetModal && resetModalContent) {
                resetModalContent.classList.add('modal-closing');
                setTimeout(() => {
                    resetModal.style.display = 'none';
                    resetModalContent.classList.remove('modal-closing');
                }, 300);
            }
        }


        function resetPhotos() {
            clearInterval(timer);
            capturing = false;
            if (countdownOverlay) countdownOverlay.textContent = "";

            photoSlots.forEach((photo, index) => {
                clearPhotoSlot(index);
                delete originalPhotos[index];
                delete originalCapturedPhotos[index];
                delete currentCroppedImages[index];
            });

            if (timerDisplay) timerDisplay.textContent = "";

            // Reset capture button
            currentCaptureSlot = 0;
            updateCaptureButton();

            if (finishButton) {
                finishButton.disabled = true;
                finishButton.classList.add('opacity-50', 'cursor-not-allowed');
            }

            if (modal) modal.style.display = 'none';

            console.log('All photos reset');
        }

        function clearPhotoSlot(index) {
            if (index < 0 || index >= photoSlots.length) return;

            const slot = photoSlots[index];
            if (slot) {
                slot.src = '';
                slot.removeAttribute('data-loaded');
                slot.style.display = 'block';
                slot.style.zIndex = '1';

                // Hapus semua versi foto
                delete originalPhotos[index];
                delete originalCapturedPhotos[index];
                delete currentCroppedImages[index];

                // Tampilkan kembali overlay
                const overlay = document.querySelector(`.photo-overlay[data-slot="${index}"]`);
                if (overlay) {
                    overlay.classList.remove('hidden');
                }

                // Update parent container
                const container = slot.closest('[data-photo-index]');
                if (container) {
                    container.setAttribute('data-has-photo', 'false');
                }

                // Update retake button state
                updateRetakeButtonsState();

                // Update capture button after photo is cleared
                updateCaptureButton();
            }
        }

        function getAllPhotoData() {
            const photos = [];
            photoSlots.forEach(slot => {
                if (!isPhotoSlotEmpty(slot)) {
                    photos.push(slot.src);
                }
            });
            return photos;
        }

        function downloadPhotoStrip() {
            const frameContainer = document.querySelector('.frame-container');
            if (!frameContainer) {
                console.error('Frame container not found');
                return;
            }

            // Simpan referensi ke semua elemen watermark
            const watermarks = frameContainer.querySelectorAll('.watermark');

            // Sembunyikan watermark sementara
            watermarks.forEach(watermark => {
                watermark.style.display = 'none';
            });

            const targetWidth = 1080;
            const scaleFactor = targetWidth / frameContainer.offsetWidth;

            html2canvas(frameContainer, {
                scale: scaleFactor,
                useCORS: true,
                logging: false
            }).then(canvas => {
                photoStripImage = canvas.toDataURL('image/png', 1.0);
                const a = document.createElement('a');
                a.href = photoStripImage;
                a.download = 'photo-strip-hd.png';
                a.click();

                updatePaymentStatusToDownloaded();

                // Hanya tampilkan tombol GIF dan Share untuk frame gratis atau setelah download selesai
                const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';
                const modalGifButton = document.getElementById('modalGifButton');
                const modalShareButton = document.getElementById('modalShareButton');

                // Jika frame gratis, pastikan tombol ada di DOM
                if (!frameIsPaid) {
                    if (modalGifButton && modalShareButton) {
                        modalGifButton.classList.remove('hidden');
                        modalShareButton.classList.remove('hidden');
                    }
                } else {
                    // Untuk frame berbayar, hanya tampilkan tombol setelah status downloaded
                    if (getCurrentPaymentStatus() === 'downloaded') {
                        // Jika tombol tidak ada di DOM, kita bisa menambahkannya secara dinamis
                        if (!modalGifButton) {
                            const gifButton = document.createElement('button');
                            gifButton.id = 'modalGifButton';
                            gifButton.className =
                                'bg-[#4CAF50] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#45a049] hover:scale-yii105 shadow-sm hover:shadow-lg';
                            gifButton.textContent = '🎬 Create GIF';
                            gifButton.addEventListener('click', createGifFromPhotos);
                            document.querySelector('#previewModal .flex-wrap').appendChild(gifButton);
                        }
                        if (!modalShareButton) {
                            const shareButton = document.createElement('button');
                            shareButton.id = 'modalShareButton';
                            shareButton.className =
                                'bg-[#BF3131] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg';
                            shareButton.textContent = '📤 Share';
                            shareButton.addEventListener('click', sharePhotoStrip);
                            document.querySelector('#previewModal .flex-wrap').appendChild(shareButton);
                        }
                    }
                }

                if (!hasShownTestimoniModal) {
                    setTimeout(() => {
                        showTestimoniModal();
                    }, 1000);
                }

                // Kembalikan visibilitas watermark setelah rendering
                watermarks.forEach(watermark => {
                    watermark.style.display = 'flex';
                });
            }).catch(error => {
                console.error('Error generating photo strip:', error);
                alert('Failed to generate HD photo strip. Try again.');

                // Pastikan watermark dikembalikan meskipun terjadi error
                watermarks.forEach(watermark => {
                    watermark.style.display = 'flex';
                });
            });
        }

        function preloadImages(container, callback) {
            const images = container.querySelectorAll('img');
            let loadedCount = 0;
            const totalImages = images.length;

            if (totalImages === 0) {
                callback();
                return;
            }

            images.forEach(img => {
                const newImg = new Image();
                newImg.crossOrigin = 'anonymous';
                newImg.onload = () => {
                    loadedCount++;
                    if (loadedCount === totalImages) {
                        callback();
                    }
                };
                newImg.onerror = () => {
                    console.error('Failed to preload image:', img.src);
                    loadedCount++;
                    if (loadedCount === totalImages) {
                        callback();
                    }
                };
                newImg.src = img.src;
            });
        }

        function openPreviewModal() {
            const frameContainer = document.querySelector('.frame-container');
            if (!frameContainer) {
                console.error('Frame container not found');
                return;
            }

            // Ensure watermarks are visible for preview
            const watermarks = frameContainer.querySelectorAll('.watermark');
            watermarks.forEach(watermark => {
                watermark.style.display = 'flex';
            });

            preloadImages(frameContainer, () => {
                const targetWidth = 1080;
                const scaleFactor = targetWidth / frameContainer.offsetWidth;
                let isPreviewGenerated = false;

                function updateModal(imageData) {
                    if (modalPhotostrip) {
                        modalPhotostrip.innerHTML = '';
                        const img = document.createElement('img');
                        img.src = imageData;
                        img.style.width = '100%';
                        modalPhotostrip.appendChild(img);
                        photoStripImage = imageData;

                        if (modal) {
                            modal.style.display = 'flex';
                            const modalContent = document.getElementById('modalContent');
                            if (modalContent) {
                                modalContent.style.transform = 'translateY(0)';
                            }

                            const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';
                            const currentStatus = getCurrentPaymentStatus();
                            const modalGifButton = document.getElementById('modalGifButton');
                            const modalShareButton = document.getElementById('modalShareButton');

                            // Jika frame gratis, pastikan tombol ditampilkan
                            if (!frameIsPaid) {
                                if (modalGifButton && modalShareButton) {
                                    modalGifButton.classList.remove('hidden');
                                    modalShareButton.classList.remove('hidden');
                                }
                            } else {
                                // Untuk frame berbayar, hanya tampilkan tombol jika status downloaded
                                if (currentStatus === 'downloaded') {
                                    if (modalGifButton && modalShareButton) {
                                        modalGifButton.classList.remove('hidden');
                                        modalShareButton.classList.remove('hidden');
                                    } else {
                                        // Tambahkan tombol secara dinamis jika belum ada
                                        if (!modalGifButton) {
                                            const gifButton = document.createElement('button');
                                            gifButton.id = 'modalGifButton';
                                            gifButton.className =
                                                'bg-[#4CAF50] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#45a049] hover:scale-105 shadow-sm hover:shadow-lg';
                                            gifButton.textContent = '🎬 Create GIF';
                                            gifButton.addEventListener('click', createGifFromPhotos);
                                            document.querySelector('#previewModal .flex-wrap').appendChild(
                                                gifButton);
                                        }
                                        if (!modalShareButton) {
                                            const shareButton = document.createElement('button');
                                            shareButton.id = 'modalShareButton';
                                            shareButton.className =
                                                'bg-[#BF3131] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg';
                                            shareButton.textContent = '📤 Share';
                                            shareButton.addEventListener('click', sharePhotoStrip);
                                            document.querySelector('#previewModal .flex-wrap').appendChild(
                                                shareButton);
                                        }
                                    }
                                } else {
                                    // Pastikan tombol tersembunyi untuk frame berbayar sebelum download
                                    if (modalGifButton) modalGifButton.classList.add('hidden');
                                    if (modalShareButton) modalShareButton.classList.add('hidden');
                                }
                            }
                        }
                    }
                    isPreviewGenerated = true;
                }

                html2canvas(frameContainer, {
                    scale: scaleFactor,
                    useCORS: true,
                    logging: false
                }).then(canvas => {
                    const imageData = canvas.toDataURL('image/png', 1.0);
                    updateModal(imageData);
                }).catch(error => {
                    console.error('Initial preview generation error:', error.message, error.stack);
                    if (!isPreviewGenerated) {
                        setTimeout(() => {
                            html2canvas(frameContainer, {
                                scale: scaleFactor,
                                useCORS: true,
                                logging: false,
                                allowTaint: true
                            }).then(canvas => {
                                const imageData = canvas.toDataURL('image/png', 1.0);
                                updateModal(imageData);
                            }).catch(fallbackError => {
                                console.error('Fallback preview generation failed:',
                                    fallbackError.message, fallbackError.stack);
                                console.warn('Failed to generate preview after retry');
                            });
                        }, 1000);
                    }
                });
            });
        }

        function updatePaymentStatusToDownloaded() {
            try {
                const pendingPaymentLS = localStorage.getItem('pendingPayment');
                if (pendingPaymentLS) {
                    const paymentDataLS = JSON.parse(pendingPaymentLS);
                    paymentDataLS.status = 'downloaded';
                    paymentDataLS.downloadedAt = Date.now();
                    localStorage.setItem('pendingPayment', JSON.stringify(paymentDataLS));
                    console.log('LocalStorage status updated to downloaded:', paymentDataLS);

                    // Setelah update status, sembunyikan tutor slide
                    checkDownloadedStatus();
                }
            } catch (error) {
                console.error('Error updating payment status to downloaded:', error);
            }
        }

        function sharePhotoStrip() {
            if (navigator.share && photoStripImage) {
                if (photoStripImage.startsWith('http')) {
                    navigator.share({
                            title: 'My Photo Strip',
                            text: 'Check out my photo strip!',
                            url: photoStripImage
                        })
                        .then(() => {
                            console.log('Shared successfully');
                            if (!hasShownTestimoniModal) {
                                setTimeout(() => {
                                    showTestimoniModal();
                                }, 1000);
                            }
                        })
                        .catch(err => {
                            console.error('Error sharing:', err);
                            alert('Sharing failed. Try downloading instead.');
                        });
                } else {
                    fetch(photoStripImage)
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], 'photo-strip.png', {
                                type: 'image/png'
                            });
                            navigator.share({
                                    title: 'My Photo Strip',
                                    text: 'Yuk, intip hasil foto dari PanoriCam! Follow @panoricam buat update seru lainnya!',
                                    files: [file]
                                })
                                .then(() => {
                                    console.log('Shared successfully');
                                    if (!hasShownTestimoniModal) {
                                        setTimeout(() => {
                                            showTestimoniModal();
                                        }, 1000);
                                    }
                                })
                                .catch(err => {
                                    console.error('Error sharing:', err);
                                    alert('Sharing failed. Try downloading instead.');
                                });
                        });
                }
            } else {
                alert('Web Share API not supported or no image available. Please download instead.');
            }
        }



        // Fungsi untuk memproses file upload (HEIC atau format lain)
        async function processUploadedPhoto(file, slotIndex) {
            console.log('Processing uploaded photo:', file.name, 'Type:', file.type);

            try {
                let imageBlob = file;

                // Deteksi jika file HEIC
                if (file.type === 'image/heic' || file.name.toLowerCase().endsWith('.heic')) {
                    showCustomAlert('Mengkonversi file HEIC, harap tunggu...', 'info', 2000);

                    // Konversi HEIC ke JPEG
                    imageBlob = await heic2any({
                        blob: file,
                        toType: 'image/jpeg',
                        quality: 0.8 // Kualitas 0-1
                    });

                    // Jika hasil konversi adalah array (beberapa gambar), ambil yang pertama
                    if (Array.isArray(imageBlob)) {
                        imageBlob = imageBlob[0];
                    }
                }

                // Lanjutkan proses seperti biasa
                const reader = new FileReader();
                reader.onload = function(e) {
                    showCropModal(e.target.result, slotIndex);
                };
                reader.readAsDataURL(imageBlob);

            } catch (error) {
                console.error('Error processing HEIC file:', error);
                showCustomAlert('Gagal memproses file HEIC. Silakan coba dengan format JPEG/PNG.', 'error');
            }
        }

        function showCropModal(imageData, slotIndex) {
            cropSlotIndex = slotIndex;
            const cropModal = document.getElementById('cropModal');
            const cropImage = document.getElementById('cropImage');
            document.querySelectorAll('.watermark').forEach(wm => {
                wm.style.display = 'none';
            });

            // Simpan foto asli jika belum ada
            if (!originalPhotos[slotIndex]) {
                originalPhotos[slotIndex] = imageData;
            }

            cropModal.style.display = 'flex';

            // Gunakan foto asli untuk recrop
            cropImage.src = originalPhotos[slotIndex];

            cropImage.onload = function() {
                if (cropper) {
                    cropper.destroy();
                }

                const photoSlot = photoSlots[slotIndex];
                const slotRect = photoSlot.getBoundingClientRect();
                const targetAspectRatio = slotRect.width / slotRect.height;

                cropper = new Cropper(cropImage, {
                    aspectRatio: targetAspectRatio,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    guides: false
                });
            };
            document.querySelectorAll('.watermark').forEach(wm => {
                wm.style.display = 'flex';
            });

            cropImage.onerror = function() {
                console.error('Failed to load image for cropping');
                closeCropModal();
            };
        }

        function confirmCrop() {
            if (!cropper || cropSlotIndex === null) {
                console.error('Cropper not initialized or no index selected');
                return;
            }

            try {
                const canvas = cropper.getCroppedCanvas({
                    width: 800,
                    height: 600,
                    minWidth: 256,
                    minHeight: 256,
                    maxWidth: 1200,
                    maxHeight: 1200,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                if (!canvas) {
                    throw new Error('Failed to get cropped canvas');
                }

                const dataUrl = canvas.toDataURL('image/png', 0.9);

                // Simpan hasil crop
                currentCroppedImages[cropSlotIndex] = dataUrl;

                // Update photo slot dengan hasil crop
                const success = setPhotoToSlot(dataUrl, cropSlotIndex);
                if (success) {
                    console.log('Cropped photo successfully set to slot', cropSlotIndex);
                } else {
                    console.error('Failed to set cropped photo to slot', cropSlotIndex);
                }

                closeCropModal();
            } catch (error) {
                console.error('Error in confirmCrop:', error);
                alert('Failed to crop image. Please try again.');
            }
        }

        function closeCropModal() {
            const cropModal = document.getElementById('cropModal');
            if (cropModal) {
                cropModal.style.display = 'none';
            }

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            cropSlotIndex = null;
        }

        function setupCropEventListeners() {
            const cropModal = document.getElementById('cropModal');
            if (!cropModal) return;

            document.getElementById('cropCancelBtn').addEventListener('click', closeCropModal);
            document.getElementById('cropConfirmBtn').addEventListener('click', confirmCrop);

            cropModal.addEventListener('click', function(e) {
                if (e.target === cropModal) {
                    closeCropModal();
                }
            });
        }

        function updateRetakeButtonsState() {
            const retakeButtons = document.querySelectorAll('.retake-button');
            const recropButtons = document.querySelectorAll('.recrop-button');
            photoSlots = document.querySelectorAll('#photo1, #photo2, #photo3');

            photoSlots.forEach((slot, index) => {
                const hasPhoto = !isPhotoSlotEmpty(slot);

                // Update retake buttons
                if (retakeButtons[index]) {
                    retakeButtons[index].setAttribute('data-has-photo', hasPhoto ? 'true' : 'false');
                }

                // Update recrop buttons
                if (recropButtons[index]) {
                    recropButtons[index].setAttribute('data-has-photo', hasPhoto ? 'true' : 'false');
                }

                // Update parent container
                const container = slot.closest('[data-photo-index]');
                if (container) {
                    container.setAttribute('data-has-photo', hasPhoto ? 'true' : 'false');
                }
            });

            updateCaptureButton();
            checkAllPhotosTaken();
        }

        function setupEventListeners() {
            console.log('Setting up event listeners...');

            // Camera toggle
            setupCameraToggle();
            setupFloatingCameraToggle();

            if (captureButton) {
                captureButton.addEventListener('click', () => {
                    if (capturing || captureButton.disabled) return;
                    const nextEmptySlot = findNextEmptySlot();
                    if (nextEmptySlot !== null) {
                        startCountdown(nextEmptySlot);
                    }
                });
            }

            if (uploadButton && fileInput) {
                uploadButton.addEventListener('click', () => {
                    if (fileInput) {
                        fileInput.value = '';
                        fileInput.click();
                    }
                });
            }

            if (fileInput) {
                fileInput.addEventListener('change', async (e) => {
                    console.log('File input change triggered:', e.target.files.length);
                    if (e.target.files && e.target.files[0]) {
                        selectedFile = e.target.files[0];
                        console.log('File selected:', selectedFile.name);

                        // Tampilkan modal upload
                        if (uploadModal) {
                            uploadModal.style.display = 'flex';
                        }
                    }
                });
            }

            slotSelectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedSlotIndex = parseInt(this.getAttribute('data-slot'));
                    if (selectedFile && selectedSlotIndex !== null) {
                        processUploadedPhoto(selectedFile, selectedSlotIndex);
                        if (uploadModal) uploadModal.style.display = 'none';
                        if (fileInput) fileInput.value = '';
                        selectedFile = null;
                        selectedSlotIndex = null;
                    }
                });
            });

            if (uploadModalClose) {
                uploadModalClose.addEventListener('click', () => {
                    if (uploadModal) uploadModal.style.display = 'none';
                    if (fileInput) fileInput.value = '';
                    selectedFile = null;
                    selectedSlotIndex = null;
                });
            }

            if (finishButton) {
                finishButton.addEventListener('click', openPreviewModal);
            }

            if (modalDownloadButton) modalDownloadButton.addEventListener('click', downloadPhotoStrip);
            if (modalShareButton) modalShareButton.addEventListener('click', sharePhotoStrip);
            if (modalGifButton) modalGifButton.addEventListener('click', createGifFromPhotos);

            window.addEventListener('click', (e) => {
                if (modal && e.target === modal) {
                    modal.style.display = 'none';
                }
                if (uploadModal && e.target === uploadModal) {
                    uploadModal.style.display = 'none';
                    if (fileInput) fileInput.value = '';
                    selectedFile = null;
                    selectedSlotIndex = null;
                }
            });
        }


        function debugPhotoSlots() {
            photoSlots = document.querySelectorAll('#photo1, #photo2, #photo3');
            console.log(`Debugging ${photoSlots.length} photo slots`);
            photoSlots.forEach((slot, index) => {
                console.log(`Slot ${index}:`, {
                    src: slot.src ? slot.src.substring(0, 50) + '...' : 'empty',
                    display: getComputedStyle(slot).display,
                    width: slot.width,
                    height: slot.height,
                    computed: {
                        width: getComputedStyle(slot).width,
                        height: getComputedStyle(slot).height
                    },
                    parentClasses: slot.parentElement ? slot.parentElement.className : 'no parent',
                    hasPhoto: retakeButtons[index] ? retakeButtons[index].getAttribute('data-has-photo') :
                        'no button'
                });
            });
        }

        // Update initialize function to include new toggle setup
        function initialize() {
            if (isInitialized) {
                console.log('Already initialized, skipping...');
                return;
            }
            isInitialized = true;

            console.log('Initializing photo booth...');

            setTimeout(() => {
                photoSlots = document.querySelectorAll('#photo1, #photo2, #photo3');
                retakeButtons = document.querySelectorAll('.retake-button');
                slotSelectButtons = document.querySelectorAll('.slot-select-button');

                console.log('Found photo slots:', photoSlots.length);

                photoSlots.forEach((slot, index) => {
                    if (slot) {
                        slot.style.display = 'block';
                        slot.style.width = '100%';
                        slot.style.height = '100%';
                        slot.style.objectFit = 'cover';
                        slot.style.objectPosition = 'center';
                        slot.src = '';
                        slot.alt = `Photo slot ${index + 1}`;
                        slot.style.position = 'relative';
                        slot.style.zIndex = '1';
                        console.log(`Photo slot ${index} initialized`);

                        const container = slot.closest('.photo-slot-container');
                        if (container) {
                            container.setAttribute('data-photo-index', index);
                            container.setAttribute('data-has-photo', 'false');
                        }
                    }
                });

                initializeWebcam('user');
                setupFilterChange();
                setupMirrorToggle();
                setupCountdownToggle();
                setupFlashToggle();
                setupSettingsToggle();
                setupEventListeners();
                setupTestimoniEventListeners();
                setupRetakeButtonListeners();
                setupResetButtonListener();
                setupWelcomeModalListeners(); // Tambahkan ini
                showWelcomeModal(); // Tambahkan ini
                setupRecropButtons();
                setupRecropEventListeners();
                setupCropEventListeners();

                if (captureButton) {
                    captureButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5" fill="currentColor">
                    <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                </svg>
                Capture 0/3
            `;
                }

                updateCaptureButton();
                updateRetakeButtonsState();

                debugPhotoSlots();
            }, 100);
        }

        function setupSettingsToggle() {
            const settingsToggle = document.getElementById('floatingSettingsToggle');
            const floatingOptions = document.getElementById('floatingOptions');

            if (settingsToggle && floatingOptions) {
                settingsToggle.addEventListener('click', () => {
                    isSettingsOpen = !isSettingsOpen;
                    floatingOptions.classList.toggle('hidden', !isSettingsOpen);
                    settingsToggle.classList.toggle('active', isSettingsOpen);
                    settingsToggle.title = isSettingsOpen ? 'Close Settings' : 'Settings';
                    console.log('Settings toggled:', isSettingsOpen);
                });
                console.log('Settings toggle event listener added');
            } else {
                console.error('Settings toggle or options container not found');
            }
        }

        function setupMirrorToggle() {
            const mirrorToggle = document.getElementById('floatingMirrorToggle');
            if (mirrorToggle) {
                mirrorToggle.addEventListener('click', () => {
                    isMirrored = !isMirrored;
                    updateMirrorEffect();
                    mirrorToggle.title = `Toggle Mirror: ${isMirrored ? 'On' : 'Off'}`;
                    mirrorToggle.classList.toggle('active', isMirrored);
                });
            }
        }

        function toggleCamera() {
            const newFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            console.log(`Switching from ${currentFacingMode} to ${newFacingMode}`);
            initializeWebcam(newFacingMode);
        }

        function updateCameraToggleButton() {
            const cameraToggleButton = document.getElementById('cameraToggle');
            if (cameraToggleButton) {
                const isRearCamera = currentFacingMode === 'environment';
                cameraToggleButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                <circle cx="12" cy="13" r="3"/>
                <path d="M21 15h.01M7 13h.01"/>
            </svg>
            ${isRearCamera ? 'Kamera Depan' : 'Kamera Belakang'}
        `;
            }
        }

        function setupCameraToggle() {
            const cameraToggleButton = document.getElementById('cameraToggle');
            if (cameraToggleButton) {
                cameraToggleButton.addEventListener('click', toggleCamera);
                console.log('Camera toggle button event listener added');

                // Set initial button text
                updateCameraToggleButton();
            } else {
                console.log('Camera toggle button not found');
            }
        }

        function setupFlashToggle() {
            const flashToggle = document.getElementById('floatingFlashToggle');
            if (flashToggle) {
                flashToggle.addEventListener('click', () => {
                    isFlashEnabled = !isFlashEnabled;
                    flashToggle.title = `Flash: ${isFlashEnabled ? 'On' : 'Off'}`;
                    flashToggle.classList.toggle('active', isFlashEnabled);
                    console.log('Flash toggled:', isFlashEnabled);
                });
                console.log('Flash toggle event listener added');
            } else {
                console.error('Flash toggle button not found');
            }
        }

        function updateFlashToggleVisibility() {
            const flashToggle = document.getElementById('floatingFlashToggle');
            if (!flashToggle) return;

            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            // Show flash toggle for:
            // - Front camera (always uses white overlay)
            // - Rear camera on mobile devices (uses native flash or fallback to white overlay)
            if (currentFacingMode === 'user' || (isMobile && currentFacingMode === 'environment')) {
                flashToggle.style.display = 'flex';
            } else {
                flashToggle.style.display = 'none';
                isFlashEnabled = false;
                flashToggle.classList.remove('active');
                flashToggle.title = 'Flash: Off';
            }
        }

        function setupCountdownToggle() {
            const countdownToggle = document.getElementById('floatingCountdownToggle');
            if (countdownToggle) {
                countdownToggle.addEventListener('click', () => {
                    currentCountdownIndex = (currentCountdownIndex + 1) % countdownOptions.length;
                    selectedCountdown = countdownOptions[currentCountdownIndex];
                    console.log('Countdown changed to:', selectedCountdown);
                    updateCountdownToggleButton();
                });
                console.log('Countdown toggle event listener added');
                updateCountdownToggleButton(); // Set initial state
            } else {
                console.error('Countdown toggle button not found');
            }
        }

        function updateCountdownToggleButton() {
            const countdownToggle = document.getElementById('floatingCountdownToggle');
            if (countdownToggle) {
                const countdownText = selectedCountdown === 0 ? '0s' : `${selectedCountdown}s`;
                countdownToggle.title = `Countdown: ${countdownText}`;
                countdownToggle.classList.toggle('active', selectedCountdown !== 0);
                countdownToggle.innerHTML = `
          
            <span class="countdown-text">${countdownText}</span>
        `;
            }
        }

        function setupStarRating() {
            const starRatingContainer = document.getElementById('starRating');
            if (starRatingContainer) {
                if (!starRatingContainer.previousElementSibling?.classList?.contains('rating-label')) {
                    const label = document.createElement('div');
                    label.className = 'rating-label text-center text-gray-700 font-medium mb-2';
                    label.innerHTML = 'Berikan Rating <span style="color: #ef4444;">*</span>';
                    starRatingContainer.parentNode.insertBefore(label, starRatingContainer);
                }

                const stars = starRatingContainer.querySelectorAll('.star');
                stars.forEach((star, index) => {
                    star.addEventListener('click', () => {
                        selectedRating = index + 1;
                        updateStarDisplay();
                        starRatingContainer.classList.remove('error-selection');
                    });
                });
            }
        }

        function updateStarDisplay() {
            const stars = starRating.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < selectedRating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function setupEmojiSelector() {
            const emojiSelectorContainer = document.getElementById('emojiSelector');
            if (emojiSelectorContainer) {
                if (!emojiSelectorContainer.previousElementSibling?.classList?.contains('emoji-label')) {
                    const label = document.createElement('div');
                    label.className = 'emoji-label text-center text-gray-700 font-medium mb-2';
                    label.innerHTML = 'Pilih Emoji <span style="color: #ef4444;">*</span>';
                    emojiSelectorContainer.parentNode.insertBefore(label, emojiSelectorContainer);
                }

                const emojis = emojiSelectorContainer.querySelectorAll('.emoji-option');
                emojis.forEach(emoji => {
                    emoji.addEventListener('click', () => {
                        emojis.forEach(e => e.classList.remove('selected'));
                        emoji.classList.add('selected');
                        selectedEmoji = emoji.getAttribute('data-emoji');
                        emojiSelectorContainer.classList.remove('error-selection');
                    });
                });
            }
        }

        function showTestimoniModal() {
            if (hasShownTestimoniModal) return;

            if (testimoniModal) {
                testimoniModal.style.display = 'flex';
                hasShownTestimoniModal = true;

                // Welcome message outside modal
                setTimeout(() => {
                    showCustomAlert('Silakan berikan rating dan testimoni Anda! 😊', 'info', 3000);
                }, 800);
            }
        }

        function closeTestimoniModal() {
            if (testimoniModal) {
                testimoniModal.style.display = 'none';
                // Remove any existing alerts
                const alerts = document.querySelectorAll('.custom-alert');
                alerts.forEach(alert => alert.remove());
            }
        }

        function submitTestimoniData() {
            // Validasi rating
            if (selectedRating === 0) {
                showCustomAlert('Mohon berikan rating terlebih dahulu! ⭐', 'warning');
                starRating.classList.add('animate-pulse');
                setTimeout(() => starRating.classList.remove('animate-pulse'), 2000);
                return;
            }

            // Validasi nama
            const name = testimoniName.value.trim();
            if (name.length < 2) {
                showCustomAlert('Mohon masukkan nama Anda (minimal 2 karakter)! 👤', 'error');
                testimoniName.focus();
                return;
            }

            // Validasi pesan
            const message = testimoniMessage.value.trim();
            if (message.length < 10) {
                showCustomAlert('Mohon tuliskan testimoni Anda (minimal 10 karakter)! 💬', 'error');
                testimoniMessage.focus();
                return;
            }

            // Validasi emoji
            if (!selectedEmoji) {
                showCustomAlert('Mohon pilih emoji yang sesuai dengan pengalaman Anda! 😊', 'warning');
                emojiSelector.classList.add('animate-pulse');
                setTimeout(() => emojiSelector.classList.remove('animate-pulse'), 2000);
                return;
            }

            // Dapatkan CSRF token
            const token = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!token) {
                showCustomAlert('Terjadi kesalahan sistem. Silakan refresh halaman.', 'error');
                return;
            }

            // Tampilkan loading
            const submitButton = document.getElementById('submitTestimoni');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML =
                '<span class="inline-flex items-center"><svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...</span>';

            // Kirim data
            fetch('/submitTestimoni', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        rating: selectedRating,
                        emoji: selectedEmoji,
                        name: name,
                        message: message,
                        frame_id: frameId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showCustomAlert('Terima kasih atas testimoni Anda! 🙏✨', 'success', 5000);
                        closeTestimoniModal();
                        resetTestimoniForm();

                        // Tampilkan alert terima kasih tambahan
                        setTimeout(() => {
                            showCustomAlert('Kami sangat menghargai masukan Anda! 😊', 'success', 3000);
                        }, 1500);
                    } else {
                        showCustomAlert(data.message || 'Gagal mengirim testimoni. Silakan coba lagi.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showCustomAlert('Terjadi kesalahan saat mengirim testimoni. Silakan coba lagi. 🔄', 'error');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                });
        }

        function resetTestimoniForm() {
            selectedRating = 0;
            selectedEmoji = '';

            const nameInput = document.getElementById('testimoniName');
            const messageInput = document.getElementById('testimoniMessage');
            const messageCounter = document.getElementById('messageCounter');

            // Reset form fields with visual feedback
            if (nameInput) {
                nameInput.value = '';
                nameInput.classList.remove('border-red-500', 'bg-red-50', 'border-green-500', 'bg-green-50');
            }

            if (messageInput) {
                messageInput.value = '';
                messageInput.classList.remove('border-red-500', 'bg-red-50', 'border-green-500', 'bg-green-50');
            }

            if (messageCounter) {
                messageCounter.textContent = '0/500';
                messageCounter.style.color = '#6b7280';
            }

            // Reset stars
            const stars = starRating?.querySelectorAll('.star');
            if (stars) {
                stars.forEach(star => star.classList.remove('active'));
            }

            // Reset emojis
            const emojis = emojiSelector?.querySelectorAll('.emoji-option');
            if (emojis) {
                emojis.forEach(emoji => emoji.classList.remove('selected'));
            }
        }

        // Enhanced real-time validation
        function setupRealTimeValidation() {
            const nameInput = document.getElementById('testimoniName');
            const messageInput = document.getElementById('testimoniMessage');
            const messageCounter = document.getElementById('messageCounter');

            if (nameInput) {
                nameInput.addEventListener('input', function() {
                    validateField(this, 2, 'Nama');
                });
            }

            if (messageInput) {
                messageInput.addEventListener('input', function() {
                    validateField(this, 10, 'Testimoni');

                    // Update counter
                    if (messageCounter) {
                        const count = this.value.length;
                        messageCounter.textContent = `${count}/500`;

                        if (count < 10) {
                            messageCounter.style.color = '#ef4444';
                        } else if (count > 450) {
                            messageCounter.style.color = '#f59e0b';
                        } else {
                            messageCounter.style.color = '#10b981';
                        }
                    }
                });
            }
        }

        function setupTestimoniEventListeners() {
            if (testimoniModalClose) {
                testimoniModalClose.addEventListener('click', closeTestimoniModal);
            }

            if (skipTestimoni) {
                skipTestimoni.addEventListener('click', () => {
                    showCustomAlert('Testimoni dilewati. Terima kasih sudah menggunakan photo booth! 👋', 'info',
                        3000);
                    closeTestimoniModal();
                });
            }

            if (submitTestimoni) {
                submitTestimoni.addEventListener('click', submitTestimoniData);
            }

            if (testimoniModal) {
                testimoniModal.addEventListener('click', (e) => {
                    if (e.target === testimoniModal) {
                        closeTestimoniModal();
                    }
                });
            }

            setupStarRating();
            setupEmojiSelector();
            setupRealTimeValidation();
        }

        function createGifFromPhotos() {
            const photos = getAllPhotoData();

            if (photos.length < 3) {
                alert('Need at least 3 photos to create a GIF!');
                return;
            }

            if (gifLoadingModal) {
                gifLoadingModal.style.display = 'flex';
            }

            updateGifProgress(0, 'Initializing GIF creation...');

            const gif = new GIF({
                workers: 2,
                quality: 5,
                width: 1080,
                height: 810,
                workerScript: '/js/gif.worker.js'
            });

            gif.on('progress', function(p) {
                const percentage = Math.round(p * 100);
                updateGifProgress(percentage,
                    `Processing frame ${Math.ceil(p * photos.length)} of ${photos.length}...`);
            });

            gif.on('finished', function(blob) {
                generatedGifBlob = blob;
                hideGifLoading();

                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'photo-strip-animation-hd.gif';
                a.click();

                setTimeout(() => {
                    URL.revokeObjectURL(url);
                }, 1000);

                if (!hasShownTestimoniModal) {
                    setTimeout(() => {
                        showTestimoniModal();
                    }, 1000);
                }
            });

            let processedCount = 0;
            photos.forEach((photoData, index) => {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = 1080;
                    canvas.height = 810;
                    const scale = Math.min(canvas.width / img.width, canvas.height / img.height);
                    const x = (canvas.width - img.width * scale) / 2;
                    const y = (canvas.height - img.height * scale) / 2;

                    ctx.fillStyle = '#FEF3E2';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);

                    gif.addFrame(canvas, {
                        delay: 1000
                    });

                    processedCount++;
                    updateGifProgress((processedCount / photos.length) * 50,
                        `Loading photo ${processedCount} of ${photos.length}...`);

                    if (processedCount === photos.length) {
                        updateGifProgress(50, 'Starting GIF compilation...');
                        gif.render();
                    }
                };
                img.src = photoData;
            });
        }

        function updateGifProgress(percentage, text) {
            if (gifProgressBar) {
                gifProgressBar.style.width = percentage + '%';
            }
            if (gifProgressText) {
                gifProgressText.textContent = text;
            }
        }

        function hideGifLoading() {
            if (gifLoadingModal) {
                gifLoadingModal.style.display = 'none';
            }
        }

        function setupRealTimeValidation() {
            const nameInput = document.getElementById('testimoniName');
            const messageInput = document.getElementById('testimoniMessage');
            const messageCounter = document.getElementById('messageCounter');

            if (nameInput) {
                nameInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    if (value.length < 2) {
                        this.classList.add('error-input');
                        this.classList.remove('valid-input');
                    } else {
                        this.classList.add('valid-input');
                        this.classList.remove('error-input');
                    }
                });

                nameInput.addEventListener('blur', function() {
                    const value = this.value.trim();
                    if (value.length === 0) {
                        this.classList.add('error-input');
                        this.classList.remove('valid-input');
                    }
                });
            }

            if (messageInput && messageCounter) {
                messageInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    const length = value.length;

                    messageCounter.textContent = `${length}/500`;

                    if (length < 10) {
                        this.classList.add('error-input');
                        this.classList.remove('valid-input');
                        messageCounter.style.color = '#ef4444';
                    } else if (length > 500) {
                        this.classList.add('error-input');
                        this.classList.remove('valid-input');
                        messageCounter.style.color = '#ef4444';
                    } else {
                        this.classList.add('valid-input');
                        this.classList.remove('error-input');
                        messageCounter.style.color = '#10b981';
                    }
                });

                messageInput.addEventListener('blur', function() {
                    const value = this.value.trim();
                    if (value.length === 0) {
                        this.classList.add('error-input');
                        this.classList.remove('valid-input');
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initialize();
            const modal = document.getElementById('previewModal');
            const modalContent = document.getElementById('modalContent');
            const dragHandle = document.getElementById('dragHandle');

            if (!modal || !modalContent || !dragHandle) return;

            let isDragging = false;
            let startY = 0;
            let startTranslateY = 0;

            dragHandle.addEventListener('touchstart', startDrag, {
                passive: true
            });
            document.addEventListener('touchmove', drag, {
                passive: false
            });
            document.addEventListener('touchend', endDrag);

            dragHandle.addEventListener('mousedown', startDrag);
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', endDrag);

            function startDrag(e) {
                if (!modal.classList.contains('flex')) return;
                isDragging = true;

                startY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;

                const style = window.getComputedStyle(modalContent);
                const matrix = new DOMMatrix(style.transform);
                startTranslateY = matrix.m42;

                modalContent.classList.add('modal-dragging');
            }

            function drag(e) {
                if (!isDragging) return;

                if (e.type.includes('touch')) {
                    e.preventDefault();
                }

                const currentY = e.type.includes('touch') ? e.touches[0].clientY : e.clientY;
                const deltaY = currentY - startY;

                if (deltaY < 0) return;

                modalContent.style.transform = `translateY(${deltaY}px)`;
            }

            function endDrag(e) {
                if (!isDragging) return;
                isDragging = false;

                const style = window.getComputedStyle(modalContent);
                const matrix = new DOMMatrix(style.transform);
                const translateY = matrix.m42;

                modalContent.classList.remove('modal-dragging');

                if (translateY > 100) {
                    closeModal();
                } else {
                    modalContent.style.transform = 'translateY(0)';
                }
            }

            function getCurrentPaymentStatus() {
                try {
                    const pendingPaymentLS = localStorage.getItem('pendingPayment');
                    const paymentData = JSON.parse(pendingPaymentLS || '{}');
                    return paymentData.status || null;
                } catch (error) {
                    console.error('Error getting payment status:', error);
                    return null;
                }
            }

            // Fungsi untuk kembali ke menu utama
            function redirectToMainMenu() {
                // Bersihkan storage setelah konfirmasi kembali ke menu utama
                localStorage.removeItem('pendingPayment');

                // Redirect ke halaman utama (sesuaikan dengan route aplikasi Anda)
                window.location.href = '/'; // atau route menu utama Anda
            }

            function closeModal() {
                const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';

                // Jika frame gratis, langsung tutup modal tanpa validasi
                if (!frameIsPaid) {
                    executeCloseModal();
                    return;
                }

                // Validasi untuk frame berbayar
                const currentStatus = getCurrentPaymentStatus();

                // Jika status adalah 'approved', langsung tutup modal tanpa alert
                if (currentStatus === 'approved') {
                    executeCloseModal();
                    return;
                }

                // Jika status adalah 'downloaded', tampilkan modal konfirmasi
                if (currentStatus === 'downloaded') {
                    showExitConfirmation();
                    return;
                }

                // Untuk status lainnya (pending, null, dll), langsung tutup modal
                executeCloseModal();
            }


            // Fungsi untuk menghapus modal konfirmasi
            function removeConfirmModal(confirmModal) {
                confirmModal.querySelector('div > div').style.transform = 'scale(0.9)';
                confirmModal.style.opacity = '0';
                setTimeout(() => {
                    if (confirmModal.parentNode) {
                        confirmModal.parentNode.removeChild(confirmModal);
                    }
                }, 300);
            }

            // Fungsi untuk eksekusi close modal (animasi tutup)
            function executeCloseModal() {
                modalContent.classList.add('modal-closing');
                setTimeout(() => {
                    modal.style.display = 'none';
                    modalContent.classList.remove('modal-closing');
                    modalContent.style.transform = 'translateY(0)';
                }, 300);
            }

            // Update event listeners
            const closeButton = modal.querySelector('.modal-close');
            if (closeButton) {
                closeButton.addEventListener('click', closeModal);
            }

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Fungsi untuk handle tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display !== 'none') {
                    closeModal();
                }
            });

            function showExitConfirmation() {
                const exitModal = document.getElementById('exitConfirmationModal');
                const confirmExitButton = document.getElementById('confirmExitButton');
                const cancelExitButton = document.getElementById('cancelExitButton');
                const exitModalClose = document.querySelector('.exit-modal-close');

                if (exitModal && confirmExitButton && cancelExitButton && exitModalClose) {
                    exitModal.style.display = 'flex';

                    // Bersihkan event listener sebelumnya untuk mencegah duplikasi
                    const newConfirmButton = confirmExitButton.cloneNode(true);
                    confirmExitButton.parentNode.replaceChild(newConfirmButton, confirmExitButton);
                    const newCancelButton = cancelExitButton.cloneNode(true);
                    cancelExitButton.parentNode.replaceChild(newCancelButton, cancelExitButton);
                    const newCloseButton = exitModalClose.cloneNode(true);
                    exitModalClose.parentNode.replaceChild(newCloseButton, exitModalClose);

                    // Tambahkan event listener baru
                    document.querySelector('#confirmExitButton').addEventListener('click', () => {
                        executeCloseModal();
                        setTimeout(() => {
                            redirectToMainMenu();
                        }, 400); // Delay untuk animasi close
                    });

                    document.querySelector('#cancelExitButton').addEventListener('click',
                        closeExitConfirmationModal);
                    document.querySelector('.exit-modal-close').addEventListener('click',
                        closeExitConfirmationModal);

                    // exitModal.addEventListener('click', (e) => {
                    //     if (e.target === exitModal) {
                    //         closeExitConfirmationModal();
                    //     }
                    // }, {
                    //     once: true
                    // });

                    // Fokus pada tombol Batal untuk aksesibilitas
                    document.querySelector('#cancelExitButton').focus();
                } else {
                    console.error('Exit confirmation modal elements not found');
                    // Fallback ke confirm browser jika modal tidak ditemukan
                    const userConfirmed = confirm(
                        "Anda telah mendownload foto. Apakah Anda yakin ingin kembali ke menu utama?"
                    );
                    if (userConfirmed) {
                        executeCloseModal();
                        setTimeout(() => {
                            redirectToMainMenu();
                        }, 400);
                    }
                }
            }

            function closeExitConfirmationModal() {
                const exitModal = document.getElementById('exitConfirmationModal');
                const exitModalContent = document.getElementById('exitConfirmationModalContent');
                if (exitModal && exitModalContent) {
                    exitModalContent.classList.add('modal-closing');
                    setTimeout(() => {
                        exitModal.style.display = 'none';
                        exitModalContent.classList.remove('modal-closing');
                    }, 300);
                }
            }
        });

        function setupFloatingCameraToggle() {
            const floatingToggle = document.getElementById('floatingCameraToggle');
            if (floatingToggle) {
                // Remove existing listeners to prevent duplicates
                floatingToggle.removeEventListener('click', toggleCamera);
                floatingToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Floating camera toggle clicked');
                    toggleCamera();
                }, {
                    passive: false
                });
                console.log('Floating camera toggle event listener added');
            } else {
                console.error('Floating camera toggle button not found');
            }
        }

        function updateFloatingCameraToggleButton() {
            const floatingToggle = document.getElementById('floatingCameraToggle');
            if (floatingToggle) {
                const isRearCamera = currentFacingMode === 'environment';
                floatingToggle.title = isRearCamera ? 'Switch to Front Camera' : 'Switch to Rear Camera';
                floatingToggle.innerHTML = `
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        `;
            }
        }
        // Fungsi utama untuk validasi akses booth
        function validateBoothAccess() {
            try {
                // Cek apakah frame berbayar
                const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';

                // Jika frame gratis, skip validasi akses
                if (!frameIsPaid) {
                    console.log('Frame is free - skipping booth access validation');
                    return true;
                }

                // Validasi untuk frame berbayar
                console.log('Frame is paid - validating booth access...');

                const pendingPaymentLS = localStorage.getItem('pendingPayment');

                // Jika tidak ada data sama sekali
                if (!pendingPaymentLS) {
                    console.warn('No payment data found in storage');
                    redirectToMainMenuWithMessage('Akses tidak valid. Silakan lakukan pembayaran terlebih dahulu.');
                    return false;
                }

                // Parse data yang ada
                const paymentData = JSON.parse(pendingPaymentLS || pendingPaymentSS || '{}');

                // Validasi struktur data dan field yang diperlukan
                if (!isValidPaymentData(paymentData)) {
                    console.warn('Invalid payment data structure:', paymentData);
                    cleanupInvalidStorage();
                    redirectToMainMenuWithMessage('Data pembayaran tidak valid. Silakan ulangi proses pembayaran.');
                    return false;
                }

                // Validasi status pembayaran
                if (!isValidPaymentStatus(paymentData.status)) {
                    console.warn('Invalid payment status:', paymentData.status);
                    redirectToMainMenuWithMessage(
                        'Status pembayaran tidak valid. Silakan lakukan pembayaran terlebih dahulu.');
                    return false;
                }

                // Tambahkan validasi untuk status "downloaded"
                if (paymentData && paymentData.status === 'downloaded') {
                    console.log('Maaf, Anda sudah tidak memiliki akses, redirecting to home page...', paymentData);
                    redirectToMainMenuWithMessage('Sesi Anda telah selesai karena foto sudah didownload.');
                    return false;
                }

                // Validasi parameter URL dengan data storage
                if (!validateUrlParameters(paymentData)) {
                    console.warn('URL parameters do not match storage data');
                    redirectToMainMenuWithMessage('Parameter akses tidak sesuai. Silakan akses melalui proses yang benar.');
                    return false;
                }

                // Validasi waktu akses (opsional - jika ingin membatasi waktu akses)
                if (!isAccessTimeValid(paymentData)) {
                    console.warn('Access time expired');
                    cleanupExpiredStorage();
                    redirectToMainMenuWithMessage('Waktu akses telah berakhir. Silakan lakukan pembayaran ulang.');
                    return false;
                }

                console.log('Booth access validation passed');
                return true;

            } catch (error) {
                console.error('Error validating booth access:', error);

                // Cek lagi apakah frame berbayar sebelum cleanup
                const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';
                if (frameIsPaid) {
                    cleanupInvalidStorage();
                    redirectToMainMenuWithMessage('Terjadi kesalahan validasi. Silakan coba lagi.');
                    return false;
                } else {
                    // Jika frame gratis dan ada error, tetap izinkan akses
                    console.log('Frame is free - allowing access despite validation error');
                    return true;
                }
            }
        }
        // Fungsi untuk validasi struktur data pembayaran
        function isValidPaymentData(paymentData) {
            if (!paymentData || typeof paymentData !== 'object') {
                return false;
            }

            // Field yang harus ada
            const requiredFields = ['order_id', 'frame_id', 'status'];

            for (const field of requiredFields) {
                if (!paymentData[field]) {
                    console.warn(`Missing required field: ${field}`);
                    return false;
                }
            }

            return true;
        }

        // Fungsi untuk validasi status pembayaran
        function isValidPaymentStatus(status) {
            const validStatuses = ['approved', 'downloaded'];
            return validStatuses.includes(status);
        }

        // Fungsi untuk validasi parameter URL dengan data storage
        function validateUrlParameters(paymentData) {
            try {
                // Ambil parameter dari URL
                const urlParams = new URLSearchParams(window.location.search);
                const urlFrameId = urlParams.get('frame_id');
                const urlOrderId = urlParams.get('order_id');

                // Jika tidak ada parameter URL, masih valid jika data storage lengkap
                if (!urlFrameId && !urlOrderId) {
                    return true;
                }

                // Jika ada parameter URL, harus sesuai dengan data storage
                if (urlFrameId && urlFrameId !== paymentData.frame_id) {
                    console.warn('Frame ID mismatch:', urlFrameId, 'vs', paymentData.frame_id);
                    return false;
                }

                if (urlOrderId && urlOrderId !== paymentData.order_id) {
                    console.warn('Order ID mismatch:', urlOrderId, 'vs', paymentData.order_id);
                    return false;
                }

                return true;

            } catch (error) {
                console.error('Error validating URL parameters:', error);
                return true; // Jika error parsing URL, tetap izinkan akses
            }
        }

        // Fungsi untuk validasi waktu akses (opsional)
        function isAccessTimeValid(paymentData) {
            // Jika tidak ada timestamp, anggap valid
            if (!paymentData.timestamp) {
                return true;
            }

            const currentTime = Date.now();
            const paymentTime = paymentData.timestamp;
            const timeDifference = currentTime - paymentTime;

            // Batasi akses maksimal 24 jam (86400000 ms)
            const maxAccessTime = 24 * 60 * 60 * 1000; // 24 jam

            return timeDifference <= maxAccessTime;
        }

        // Fungsi untuk membersihkan storage yang tidak valid
        function cleanupInvalidStorage() {
            localStorage.removeItem('pendingPayment');
            console.log('Invalid storage data cleaned up');
        }

        // Fungsi untuk membersihkan storage yang expired
        function cleanupExpiredStorage() {
            localStorage.removeItem('pendingPayment');
            console.log('Expired storage data cleaned up');
        }

        function redirectToMainMenuWithMessage(message) {
            if (hasShownSessionEndAlert) {
                console.log('Session end alert already shown, skipping...');
                return;
            }

            hasShownSessionEndAlert = true;

            const sessionEndModal = document.getElementById('sessionEndModal');
            const sessionEndModalContent = document.getElementById('sessionEndModalContent');
            const confirmSessionEndButton = document.getElementById('confirmSessionEndButton');
            const sessionEndModalClose = document.querySelector('.session-end-modal-close');

            if (sessionEndModal && sessionEndModalContent && confirmSessionEndButton && sessionEndModalClose) {
                // Update modal message
                const messageElement = sessionEndModalContent.querySelector('p');
                if (messageElement) {
                    messageElement.textContent = message;
                }

                // Show modal
                sessionEndModal.style.display = 'flex';

                // Clone buttons to avoid duplicate event listeners
                const newConfirmButton = confirmSessionEndButton.cloneNode(true);
                confirmSessionEndButton.parentNode.replaceChild(newConfirmButton, confirmSessionEndButton);
                const newCloseButton = sessionEndModalClose.cloneNode(true);
                sessionEndModalClose.parentNode.replaceChild(newCloseButton, sessionEndModalClose);

                // Add event listeners
                document.querySelector('#confirmSessionEndButton').addEventListener('click', () => {
                    closeSessionEndModal();
                    setTimeout(() => {
                        redirectToMainMenu();
                    }, 400); // Delay for animation
                });



                // Focus on confirm button for accessibility
                document.querySelector('#confirmSessionEndButton').focus();
            } else {
                // Fallback to alert if modal elements are missing
                console.error('Session end modal elements not found, falling back to alert');
                alert(message);
                redirectToMainMenu();
            }
        }



        // Fungsi untuk validasi lanjutan berdasarkan IP atau device (opsional)
        function validateDeviceAccess(paymentData) {
            // Simpan device fingerprint saat pembayaran
            // Validasi device yang sama saat akses booth

            const currentFingerprint = generateDeviceFingerprint();

            if (paymentData.deviceFingerprint && paymentData.deviceFingerprint !== currentFingerprint) {
                console.warn('Device fingerprint mismatch');
                return false;
            }

            return true;
        }

        // Fungsi untuk generate device fingerprint sederhana
        function generateDeviceFingerprint() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            ctx.textBaseline = 'top';
            ctx.font = '14px Arial';
            ctx.fillText('Device fingerprint test', 2, 2);

            return btoa(
                navigator.userAgent +
                navigator.language +
                screen.width + 'x' + screen.height +
                new Date().getTimezoneOffset() +
                canvas.toDataURL()
            ).substring(0, 32);
        }

        // Fungsi untuk dijalankan saat halaman booth dimuat
        function initializeBoothPage() {
            // Validasi akses sebelum inisialisasi apapun
            if (!validateBoothAccess()) {
                return; // Stop execution jika validasi gagal
            }

            // Lanjutkan inisialisasi halaman booth jika validasi berhasil
            console.log('Booth access validated successfully');

            // Inisialisasi komponen booth lainnya di sini
            initializeCamera();
            setupFrameDisplay();
            attachBoothEventListeners();

            // Update URL jika diperlukan
            updateUrlFromStorage();
        }

        // Fungsi untuk update URL berdasarkan data storage
        function updateUrlFromStorage() {
            try {
                const pendingPaymentLS = localStorage.getItem('pendingPayment');
                const paymentData = JSON.parse(pendingPaymentLS || '{}');

                if (paymentData.frame_id && paymentData.order_id) {
                    const newUrl =
                        `/booth?frame_id=${encodeURIComponent(paymentData.frame_id)}&order_id=${encodeURIComponent(paymentData.order_id)}`;

                    // Update URL tanpa reload halaman
                    if (window.location.pathname + window.location.search !== newUrl) {
                        window.history.replaceState({}, '', newUrl);
                    }
                }
            } catch (error) {
                console.error('Error updating URL from storage:', error);
            }
        }

        // Event listener untuk DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeBoothPage();
            const frameIsPaidElement = document.getElementById('frameIsPaid');

            if (!frameIsPaidElement) {
                console.error('frameIsPaid element not found');
                return;
            }

            // Jalankan inisialisasi validasi
            if (!initializeFrameValidation()) {
                console.log('Frame validation failed');
                return;
            }

            console.log('Frame validation completed successfully');
        });

        // Event listener untuk deteksi jika user mencoba akses langsung
        window.addEventListener('pageshow', function(event) {
            // Validasi ulang saat halaman ditampilkan (termasuk dari cache)
            if (!validateBoothAccess()) {
                return;
            }
        });

        function initializeFrameValidation() {
            const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';

            if (frameIsPaid) {
                // Pastikan semua elemen crop/recrop di-enable
                document.querySelectorAll('.recrop-button, .crop-button').forEach(btn => {
                    btn.disabled = false;
                });

                // Validasi pembayaran
                if (!validateBoothAccess()) {
                    return false;
                }
            }

            return true;
        }

        function conditionalCleanupStorage() {
            const frameIsPaid = document.getElementById('frameIsPaid').value === 'true';

            if (frameIsPaid) {
                // Bersihkan storage hanya untuk frame berbayar
                localStorage.removeItem('pendingPayment');
                console.log('Storage cleaned for paid frame');
            } else {
                console.log('Storage cleanup skipped for free frame');
            }
        }

        // Event listener untuk mencegah akses melalui back button tanpa data valid
        window.addEventListener('popstate', function(event) {
            // Validasi ulang saat user menggunakan back/forward button
            setTimeout(() => {
                if (!validateBoothAccess()) {
                    return;
                }
            }, 100);
        });


        window.addEventListener('beforeunload', () => {
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
            }
        });

        function showWelcomeModal() {
            // Cek status downloaded terlebih dahulu
            if (checkDownloadedStatus()) {
                console.log('Welcome modal skipped because photo already downloaded');
                return;
            }

            const welcomeModal = document.getElementById('welcomeModal');
            if (welcomeModal) {
                welcomeModal.style.display = 'flex';
                currentWelcomeStep = 0; // Reset to first step
                updateWelcomeStep();
            }
        }

        // Fungsi untuk memperbarui tampilan langkah
        function updateWelcomeStep() {
            const steps = document.querySelectorAll('.welcome-step');
            const indicators = document.querySelectorAll('.step-indicator');
            const prevButton = document.getElementById('welcomePrevButton');
            const nextButton = document.getElementById('welcomeNextButton');
            const finishButton = document.getElementById('welcomeFinishButton');

            // Pastikan semua langkah disembunyikan terlebih dahulu
            steps.forEach(step => step.classList.remove('active'));

            // Tampilkan langkah aktif
            if (steps[currentWelcomeStep]) {
                steps[currentWelcomeStep].classList.add('active');
            }

            // Update indikator
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentWelcomeStep);
            });

            // Update tombol navigasi
            if (prevButton) {
                prevButton.classList.toggle('hidden', currentWelcomeStep === 0);
            }
            if (nextButton) {
                nextButton.classList.toggle('hidden', currentWelcomeStep >= totalWelcomeSteps - 1);
            }
            if (finishButton) {
                finishButton.classList.toggle('hidden', currentWelcomeStep < totalWelcomeSteps - 1);
            }
        }

        // Fungsi untuk menutup modal langkah-langkah
        function closeWelcomeModal() {
            const welcomeModal = document.getElementById('welcomeModal');
            if (welcomeModal) {
                welcomeModal.style.display = 'none';
            }
        }

        function getCurrentPaymentStatus() {
            try {
                const pendingPaymentLS = localStorage.getItem('pendingPayment');
                const paymentData = JSON.parse(pendingPaymentLS || '{}');
                return paymentData.status || null;
            } catch (error) {
                console.error('Error getting payment status:', error);
                return null;
            }
        }

        function notifyServerPhotoDownloaded() {
            try {
                const tokenElement = document.querySelector('meta[name="csrf-token"]');
                if (!tokenElement) {
                    console.error('CSRF token not found');
                    return;
                }

                const token = tokenElement.getAttribute('content');
                const frameId = document.getElementById('frameId').value;
                const orderId = new URLSearchParams(window.location.search).get('order_id');

                if (!frameId || !orderId) {
                    console.error('Missing frame_id or order_id');
                    return;
                }

                fetch('/notify-download', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            frame_id: frameId,
                            order_id: orderId,
                            status: 'downloaded'
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log('Server notified of download');
                        } else {
                            console.error('Server notification failed:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error notifying server:', error);
                    });
            } catch (error) {
                console.error('Error in notifyServerPhotoDownloaded:', error);
            }
        }

        // Setup event listeners untuk modal langkah-langkah
        function setupWelcomeModalListeners() {
            const welcomeModal = document.getElementById('welcomeModal');
            const prevButton = document.getElementById('welcomePrevButton');
            const nextButton = document.getElementById('welcomeNextButton');
            const finishButton = document.getElementById('welcomeFinishButton');
            const closeButton = document.querySelector('.welcome-modal-close');

            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    if (currentWelcomeStep > 0) {
                        currentWelcomeStep--;
                        updateWelcomeStep();
                    }
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    if (currentWelcomeStep < totalWelcomeSteps - 1) {
                        currentWelcomeStep++;
                        updateWelcomeStep();
                    }
                });
            }

            if (finishButton) {
                finishButton.addEventListener('click', closeWelcomeModal);
            }

            if (closeButton) {
                closeButton.addEventListener('click', closeWelcomeModal);
            }

            if (welcomeModal) {
                welcomeModal.addEventListener('click', (e) => {
                    if (e.target === welcomeModal) {
                        closeWelcomeModal();
                    }
                });
            }
        }

        function showCustomAlert(message, type = 'info', duration = 4000) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.custom-alert');
            existingAlerts.forEach(alert => alert.remove());

            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className =
                `custom-alert fixed top-4 left-1/2 transform -translate-x-1/2 z-[70] px-6 py-4 rounded-xl shadow-2xl max-w-md w-[90%] transition-all duration-300 ease-in-out`;

            // Set alert styles based on type with more vibrant colors
            switch (type) {
                case 'success':
                    alertDiv.className +=
                        ' bg-gradient-to-r from-green-500 to-green-600 text-white border-l-4 border-green-700';
                    break;
                case 'error':
                    alertDiv.className += ' bg-gradient-to-r from-red-500 to-red-600 text-white border-l-4 border-red-700';
                    break;
                case 'warning':
                    alertDiv.className +=
                        ' bg-gradient-to-r from-yellow-500 to-yellow-600 text-white border-l-4 border-yellow-700';
                    break;
                default:
                    alertDiv.className +=
                        ' bg-gradient-to-r from-blue-500 to-blue-600 text-white border-l-4 border-blue-700';
            }

            // Alert content with better styling
            alertDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-2xl mr-3 animate-bounce">${getAlertIcon(type)}</span>
                <span class="font-semibold text-sm">${message}</span>
            </div>
        </div>
    `;

            // Add to page - ensure it's outside modal
            document.body.appendChild(alertDiv);

            // Initial state for animation
            alertDiv.style.transform = 'translateX(-50%) translateY(-100%)';
            alertDiv.style.opacity = '0';

            // Animate in
            setTimeout(() => {
                alertDiv.style.transform = 'translateX(-50%) translateY(0)';
                alertDiv.style.opacity = '1';
            }, 100);

            // Auto remove after duration
            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.style.transform = 'translateX(-50%) translateY(-100%)';
                    alertDiv.style.opacity = '0';
                    setTimeout(() => alertDiv.remove(), 300);
                }
            }, duration);
        }

        function getAlertIcon(type) {
            switch (type) {
                case 'success':
                    return '✅';
                case 'error':
                    return '❌';
                case 'warning':
                    return '⚠️';
                default:
                    return 'ℹ️';
            }
        }

        // Simplified validation alerts - all outside modal
        function showValidationAlert(message, type = 'error', focusElement = null) {
            showCustomAlert(message, type, 4000);

            // Focus on problematic element if provided
            if (focusElement) {
                setTimeout(() => {
                    focusElement.focus();
                    focusElement.classList.add('animate-pulse');
                    setTimeout(() => focusElement.classList.remove('animate-pulse'), 2000);
                }, 500);
            }
        }

        // Enhanced form validation with visual feedback
        function validateField(field, minLength, fieldName) {
            const value = field.value.trim();

            if (!value || value.length < minLength) {
                field.classList.add('border-red-500', 'bg-red-50');
                field.classList.remove('border-green-500', 'bg-green-50');
                return false;
            } else {
                field.classList.add('border-green-500', 'bg-green-50');
                field.classList.remove('border-red-500', 'bg-red-50');
                return true;
            }
        }

        function checkDownloadedStatus() {
            try {
                const pendingPayment = localStorage.getItem('pendingPayment');
                if (pendingPayment) {
                    const paymentData = JSON.parse(pendingPayment);
                    return paymentData.status === 'downloaded';
                }
                return false;
            } catch (error) {
                console.error('Error checking downloaded status:', error);
                return false;
            }
        }

        function closeSessionEndModal() {
            const sessionEndModal = document.getElementById('sessionEndModal');
            const sessionEndModalContent = document.getElementById('sessionEndModalContent');
            if (sessionEndModal && sessionEndModalContent) {
                sessionEndModalContent.classList.add('modal-closing');
                setTimeout(() => {
                    sessionEndModal.style.display = 'none';
                    sessionEndModalContent.classList.remove('modal-closing');
                }, 300);
            }
        }

        function setupRecropButtons() {
            document.addEventListener('click', function(e) {
                const recropBtn = e.target.closest('.recrop-button');
                if (recropBtn) {
                    e.preventDefault();
                    e.stopPropagation();

                    const index = parseInt(recropBtn.getAttribute('data-index'));
                    const hasPhoto = recropBtn.getAttribute('data-has-photo') === 'true';

                    if (hasPhoto && !capturing) {
                        showRecropModal(index);
                    }
                }
            });
        }

        function showRecropModal(index) {
            currentRecropIndex = index;
            const recropModal = document.getElementById('recropModal');
            const recropImage = document.getElementById('recropImage');

            recropModal.style.display = 'flex';

            // Gunakan foto asli dengan efek yang sudah diterapkan
            recropImage.src = originalCapturedPhotos[index] || originalPhotos[index] || photoSlots[index].src;

            recropImage.onload = function() {
                if (cropper) {
                    cropper.destroy();
                }

                const photoSlot = photoSlots[index];
                const slotRect = photoSlot.getBoundingClientRect();
                const targetAspectRatio = slotRect.width / slotRect.height;

                // Buat cropper dengan orientasi yang sesuai
                cropper = new Cropper(recropImage, {
                    aspectRatio: targetAspectRatio,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    guides: false,
                    // Pertahankan orientasi asli (tidak perlu mirror lagi karena sudah diterapkan)
                    scalable: false,
                    zoomable: false
                });
            };

            recropImage.onerror = function() {
                console.error('Failed to load image for cropping');
                closeRecropModal();
            };
        }

        function confirmRecrop() {
            if (!cropper || currentRecropIndex === null) {
                console.error('Cropper not initialized or no index selected');
                return;
            }

            try {
                const canvas = cropper.getCroppedCanvas({
                    width: 480,
                    height: 308,
                    minWidth: 256,
                    minHeight: 256,
                    maxWidth: 800,
                    maxHeight: 800,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                if (!canvas) {
                    throw new Error('Failed to get cropped canvas');
                }

                const dataUrl = canvas.toDataURL('image/png', 0.9);

                // Simpan gambar yang sudah di-crop
                currentCroppedImages[currentRecropIndex] = dataUrl;

                // Update photo slot
                setPhotoToSlot(dataUrl, currentRecropIndex);

                closeRecropModal();
            } catch (error) {
                console.error('Error in confirmRecrop:', error);
                alert('Failed to crop image. Please try again.');
            }
        }

        function closeRecropModal() {
            const recropModal = document.getElementById('recropModal');
            if (recropModal) {
                recropModal.style.display = 'none';
            }

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        function setupRecropEventListeners() {
            const recropModal = document.getElementById('recropModal');
            if (!recropModal) return;

            // Hapus event listener lama jika ada
            document.getElementById('recropCancelBtn')?.removeEventListener('click', closeRecropModal);
            document.getElementById('recropConfirmBtn')?.removeEventListener('click', confirmRecrop);

            // Tambahkan event listener baru
            document.getElementById('recropCancelBtn').addEventListener('click', closeRecropModal);
            document.getElementById('recropConfirmBtn').addEventListener('click', confirmRecrop);

            recropModal.addEventListener('click', function(e) {
                if (e.target === recropModal) {
                    closeRecropModal();
                }
            });

            const ratioSelect = document.getElementById('recropRatioSelect');
            if (ratioSelect) {
                ratioSelect.addEventListener('change', function() {
                    if (cropper) {
                        const ratio = this.value.split(':');
                        cropper.setAspectRatio(ratio[0] / ratio[1]);
                    }
                });
            }
        }

        // Inisialisasi saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            setupRecropButtons();
            setupRecropEventListeners();
        });

        function resetCrop(index) {
            delete currentCroppedImages[index];
            // Jika ingin langsung memperbarui tampilan:
            const photoSlot = photoSlots[index];
            if (photoSlot) {
                photoSlot.src = originalImageData;
            }
        }
        // Fungsi untuk menampilkan status konversi
        function showHEICConversionStatus() {
            const statusDiv = document.createElement('div');
            statusDiv.id = 'heic-conversion-status';
            statusDiv.className =
                'fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-2 rounded-lg z-50';
            statusDiv.innerHTML = 'Mengkonversi HEIC ke JPEG... <span class="ml-2 animate-spin">⏳</span>';
            document.body.appendChild(statusDiv);
        }

        function hideHEICConversionStatus() {
            const statusDiv = document.getElementById('heic-conversion-status');
            if (statusDiv) {
                statusDiv.remove();
            }
        }
        // Fungsi utama untuk handle upload
        async function handleFileUpload(file, slotIndex) {
            try {
                // Tampilkan indikator loading
                showHEICConversionStatus();

                // Proses file HEIC jika diperlukan
                const processedFile = await processHEICFile(file);

                // Lanjutkan ke crop modal
                const reader = new FileReader();
                reader.onload = (e) => showCropModal(e.target.result, slotIndex);
                reader.readAsDataURL(processedFile);

            } catch (error) {
                console.error('Upload error:', error);
                showCustomAlert('Gagal memproses file: ' + error.message, 'error');
            } finally {
                hideHEICConversionStatus();
            }
        }

        // Fungsi khusus proses HEIC
        async function processHEICFile(file) {
            if (!isHEIC(file)) return file;

            showCustomAlert('File HEIC terdeteksi, mengkonversi...', 'info');

            try {
                const result = await heic2any({
                    blob: file,
                    toType: 'image/jpeg',
                    quality: 0.9
                });

                return Array.isArray(result) ? result[0] : result;
            } catch (error) {
                console.error('HEIC conversion failed:', error);
                throw new Error('Konversi HEIC gagal, silakan coba format lain');
            }
        }

        // Deteksi file HEIC
        function isHEIC(file) {
            return file.type === 'image/heic' ||
                file.type === 'image/heif' ||
                file.name.toLowerCase().endsWith('.heic') ||
                file.name.toLowerCase().endsWith('.heif');
        }

        // Update event listener slot selection
        slotSelectButtons.forEach(button => {
            button.addEventListener('click', async function() {
                selectedSlotIndex = parseInt(this.getAttribute('data-slot'));
                if (selectedFile && selectedSlotIndex !== null) {
                    await handleFileUpload(selectedFile, selectedSlotIndex);
                    if (uploadModal) uploadModal.style.display = 'none';
                    selectedFile = null;
                    selectedSlotIndex = null;
                }
            });
        });
    </script>
</body>

</html>
