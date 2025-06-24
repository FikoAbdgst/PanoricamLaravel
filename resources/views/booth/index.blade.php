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
                        class="w-full h-full bg-gray-200 rounded-xl shadow-md scale-x-[-1] object-cover"></video>
                    <div id="countdown-overlay"
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-8xl font-bold text-white pointer-events-none"
                        style="text-shadow: 0 0 10px rgba(0, 0, 0, 0.7);"></div>
                    <button id="floatingCameraToggle" class="floating-camera-toggle" title="Switch Camera">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                            <path
                                d="M448 224c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zM224 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64zm-256 0c0-17.7 14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32s-32-14.3-32-32zm256 192c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                        </svg>
                    </button>
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

                    <button id="mirrorToggle"
                        class="bg-[#BF3131] text-white border border-transparent py-2 px-3 sm:py-2.5 sm:px-4 text-sm sm:text-base font-semibold rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg w-auto">
                        Mirror: Off
                    </button>

                    <select id="countdownSelect"
                        class="py-2 px-3 sm:py-2.5 sm:px-4 rounded-xl bg-white text-sm sm:text-base font-medium cursor-pointer border-2 border-[#BF3131] transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:text-white w-auto">
                        <option value="3">3 Seconds</option>
                        <option value="5">5 Seconds</option>
                        <option value="0">No Countdown</option>
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

                    <input type="file" id="fileInput" accept="image/*" class="hidden">
                </div>
            </div>

            <div class="w-[190px] h-[500px] relative frame-container">
                <div id="frameTemplate" class="w-full h-full relative bg-white rounded-lg shadow-lg">
                    @include($templatePath, ['frame' => $frame])

                    <!-- White overlay divs dengan class untuk kontrol visibility -->
                    <div class="photo-overlay absolute top-[20px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="0">
                    </div>
                    <div class="photo-overlay absolute top-[150px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="1">
                    </div>
                    <div class="photo-overlay absolute top-[280px] left-[10px] w-[170px] h-[120px] bg-gray-100 z-10 rounded-sm border-2 border-dashed border-gray-300"
                        data-slot="2">
                    </div>
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
                <button id="modalGifButton"
                    class="bg-[#4CAF50] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#45a049] hover:scale-105 shadow-sm hover:shadow-lg">🎬
                    Create GIF</button>
                <button id="modalShareButton"
                    class="bg-[#BF3131] text-white border-none py-2 px-5 text-sm font-medium rounded-xl cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#F16767] hover:scale-105 shadow-sm hover:shadow-lg">📤
                    Share</button>
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

    <input type="hidden" id="frameId" value="{{ $frame->id }}">
    <input type="hidden" id="frameIsPaid" value="{{ $frame->isFree() ? 'false' : 'true' }}">

    <style>
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

        #mirrorToggle.active {
            background-color: #F16767;
            border-color: #BF3131;
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

        @media (max-width: 768px) {
            #video {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
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

        .floating-camera-toggle {
            position: absolute;
            display: flex;
            top: 15px;
            right: 15px;
            z-index: 30;
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


        .floating-camera-toggle svg {
            width: 24px;
            height: 24px;
            color: white;
            transition: transform 0.3s ease;
        }


        /* Sembunyikan tombol kamera toggle yang lama */
        #cameraToggle {
            display: none !important;
        }



        /* Hide floating camera toggle button on desktop (min-width: 769px) */
        @media (min-width: 769px) {
            .floating-camera-toggle {
                display: none;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
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
        let generatedGifBlob = null;

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

        let isMirrored = true;
        let selectedCountdown = 3;
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
            }

            const constraints = {
                video: {
                    aspectRatio: 4 / 3,
                    facingMode: facingMode
                }
            };

            navigator.mediaDevices.getUserMedia(constraints)
                .then(stream => {
                    currentStream = stream;
                    video.srcObject = stream;
                    currentFacingMode = facingMode;

                    // Update floating button instead of regular button
                    updateFloatingCameraToggleButton();
                })
                .catch(err => {
                    console.error("Error accessing webcam: " + err);

                    // Jika gagal dengan kamera yang diminta, coba dengan kamera lainnya
                    if (facingMode === 'environment') {
                        console.log("Trying front camera as fallback...");
                        initializeWebcam('user');
                    } else {
                        alert(
                            "Failed to access webcam. Please ensure your camera is connected and permissions are granted."
                        );
                    }
                });
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

            const slotRect = photoSlot.getBoundingClientRect();
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

            canvas.width = outputWidth;
            canvas.height = outputHeight;

            ctx.save();
            if (isMirrored) {
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
            }
            ctx.filter = getComputedStyle(video).filter;
            ctx.drawImage(
                video,
                sourceX, sourceY, sourceWidth, sourceHeight,
                0, 0, canvas.width, canvas.height
            );
            ctx.restore();

            const dataUrl = canvas.toDataURL('image/png', 0.9);

            const success = setPhotoToSlot(dataUrl, currentPhotoIndex);
            if (!success) {
                console.error('Failed to set photo to slot', currentPhotoIndex);
            }

            // Reset capture state
            resetCaptureState();
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

            if (countdownOverlay) countdownOverlay.textContent = countdown;

            // Update button to show capturing state dengan current count
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
                if (countdownOverlay) countdownOverlay.textContent = "";
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
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    const hasPhoto = this.getAttribute('data-has-photo') === 'true';

                    if (hasPhoto && !capturing) {
                        const confirmRetake = confirm("Do you want to retake this photo?");
                        if (confirmRetake) {
                            clearPhotoSlot(index);
                        }
                    }
                });
            });
        }

        function resetPhotos() {
            clearInterval(timer);
            capturing = false;
            if (countdownOverlay) countdownOverlay.textContent = "";

            photoSlots.forEach((photo, index) => {
                clearPhotoSlot(index);
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

                if (!hasShownTestimoniModal) {
                    setTimeout(() => {
                        showTestimoniModal();
                    }, 1000);
                }
            }).catch(error => {
                console.error('Error generating photo strip:', error);
                alert('Failed to generate HD photo strip. Try again.');
            });
        }

        // Fungsi untuk mengupdate status pembayaran menjadi "downloaded"
        function updatePaymentStatusToDownloaded() {
            try {
                // Cek dan update localStorage
                const pendingPaymentLS = localStorage.getItem('pendingPayment');
                if (pendingPaymentLS) {
                    const paymentDataLS = JSON.parse(pendingPaymentLS);
                    paymentDataLS.status = 'downloaded';
                    paymentDataLS.downloadedAt = Date.now(); // Tambahkan timestamp download
                    localStorage.setItem('pendingPayment', JSON.stringify(paymentDataLS));
                    console.log('LocalStorage status updated to downloaded:', paymentDataLS);
                }


                // Opsional: Kirim notifikasi ke server bahwa foto telah didownload
                notifyServerPhotoDownloaded();

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

        function openPreviewModal() {
            const frameContainer = document.querySelector('.frame-container');
            if (!frameContainer) {
                console.error('Frame container not found');
                return;
            }

            const targetWidth = 1080;
            const scaleFactor = targetWidth / frameContainer.offsetWidth;

            html2canvas(frameContainer, {
                scale: scaleFactor,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const imageData = canvas.toDataURL('image/png', 1.0);
                savePhotos(imageData);

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
                    }
                }
            }).catch(error => {
                console.error('Error generating preview:', error);
                alert('Failed to generate preview');
            });
        }

        function savePhotos(finalImage) {
            const tokenElement = document.querySelector('meta[name="csrf-token"]');
            if (!tokenElement) {
                console.error('CSRF token not found');
                return;
            }

            const token = tokenElement.getAttribute('content');

            fetch('/savePhoto', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        photos: getAllPhotoData(),
                        frame_id: frameId,
                        final_image: finalImage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Photo saved successfully');
                        if (data.download_url) {
                            photoStripImage = data.download_url;
                        }
                        console.log('Frame used count:', data.frame_info.used);
                    } else {
                        console.error('Error saving photos:', data.message);
                        alert('Failed to save photos');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to save photos');
                });
        }

        function processUploadedPhoto(file, slotIndex) {
            console.log('Processing uploaded photo:', file ? file.name : 'none', 'Slot:', slotIndex);

            if (!file) {
                console.error('No file provided');
                return;
            }
            if (slotIndex === null || slotIndex < 0 || slotIndex >= photoSlots.length) {
                console.error('Invalid slot index:', slotIndex);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const photoSlot = photoSlots[slotIndex];
                    if (!photoSlot) {
                        console.error('Photo slot not found');
                        return;
                    }

                    const slotRect = photoSlot.getBoundingClientRect();
                    const targetAspectRatio = slotRect.width / slotRect.height;
                    const imageAspectRatio = img.width / img.height;

                    let sourceWidth = img.width;
                    let sourceHeight = img.height;
                    let sourceX = 0;
                    let sourceY = 0;

                    if (imageAspectRatio > targetAspectRatio) {
                        sourceWidth = img.height * targetAspectRatio;
                        sourceX = (img.width - sourceWidth) / 2;
                    } else {
                        sourceHeight = img.width / targetAspectRatio;
                        sourceY = (img.height - sourceHeight) / 2;
                    }

                    const outputWidth = 800;
                    const outputHeight = outputWidth / targetAspectRatio;

                    const uploadCanvas = document.createElement('canvas');
                    const uploadCtx = uploadCanvas.getContext('2d');
                    uploadCanvas.width = outputWidth;
                    uploadCanvas.height = outputHeight;

                    uploadCtx.filter = filterSelect ? filterSelect.value : 'none';
                    uploadCtx.drawImage(
                        img,
                        sourceX, sourceY, sourceWidth, sourceHeight,
                        0, 0, uploadCanvas.width, uploadCanvas.height
                    );

                    const dataUrl = uploadCanvas.toDataURL('image/png', 0.9);

                    // Use setPhotoToSlot which will automatically update capture button
                    const success = setPhotoToSlot(dataUrl, slotIndex);
                    if (success) {
                        console.log('Uploaded photo successfully set to slot', slotIndex);
                        // setPhotoToSlot already calls updateCaptureButton via its onload handler
                    } else {
                        console.error('Failed to set uploaded photo to slot', slotIndex);
                    }
                };
                img.onerror = function() {
                    console.error('Failed to load uploaded image');
                    alert('Failed to load the uploaded image. Please try again.');
                };
                img.src = e.target.result;
            };
            reader.onerror = function() {
                console.error('Failed to read uploaded file');
                alert('Failed to read the uploaded file. Please try again.');
            };
            reader.readAsDataURL(file);
        }

        function updateRetakeButtonsState() {
            retakeButtons = document.querySelectorAll('.retake-button');
            photoSlots = document.querySelectorAll('#photo1, #photo2, #photo3');

            retakeButtons.forEach((button, index) => {
                if (index >= photoSlots.length) return;

                const slot = photoSlots[index];
                const hasPhoto = !isPhotoSlotEmpty(slot);

                // Update data attributes
                button.setAttribute('data-has-photo', hasPhoto ? 'true' : 'false');

                // Update parent container
                const container = slot.closest('[data-photo-index]');
                if (container) {
                    container.setAttribute('data-has-photo', hasPhoto ? 'true' : 'false');
                }
                // Button akan hidden/shown via CSS hover, tidak perlu JavaScript
                button.style.display = 'flex';
            });

            // Update capture button and check if all photos taken
            updateCaptureButton();
            checkAllPhotosTaken();
        }

        function setupEventListeners() {
            console.log('Setting up event listeners...');

            // Tambahkan setup camera toggle
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
                fileInput.addEventListener('change', (e) => {
                    console.log('File input change triggered:', e.target.files.length, Date.now());
                    if (e.target.files && e.target.files[0]) {
                        selectedFile = e.target.files[0];
                        console.log('File selected:', selectedFile.name);
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

            // Continue with other event listeners...
            if (uploadModalClose) {
                uploadModalClose.addEventListener('click', () => {
                    if (uploadModal) uploadModal.style.display = 'none';
                    if (fileInput) fileInput.value = '';
                    selectedFile = null;
                    selectedSlotIndex = null;
                });
            }

            document.querySelectorAll('.photo-slot-container').forEach((container, index) => {
                container.addEventListener('click', function() {
                    const hasPhoto = this.getAttribute('data-has-photo') === 'true';
                    if (hasPhoto && !capturing) {
                        const confirmRetake = confirm("Do you want to retake this photo?");
                        if (confirmRetake) {
                            clearPhotoSlot(index);
                        }
                    }
                });
            });

            retakeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    const hasPhoto = this.getAttribute('data-has-photo') === 'true';
                    if (hasPhoto && !capturing) {
                        const confirmRetake = confirm("Do you want to retake this photo?");
                        if (confirmRetake) {
                            clearPhotoSlot(index);
                        }
                    }
                });
            });

            if (finishButton) {
                finishButton.addEventListener('click', openPreviewModal);
            }

            if (resetButton) resetButton.addEventListener('click', resetPhotos);
            if (modalDownloadButton) modalDownloadButton.addEventListener('click', downloadPhotoStrip);
            if (modalShareButton) modalShareButton.addEventListener('click', sharePhotoStrip);
            if (modalGifButton) modalGifButton.addEventListener('click', createGifFromPhotos);

            setupRetakeButtonListeners();

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
                        slot.alt = '';
                        slot.style.position = 'relative';
                        slot.style.zIndex = '1';
                        console.log(`Photo slot ${index} initialized`);
                    }
                });

                // Initialize webcam dengan kamera depan sebagai default
                initializeWebcam('user');
                setupFilterChange();
                setupMirrorToggle();
                setupCountdownSelect();
                setupEventListeners();
                setupTestimoniEventListeners();

                // Initialize capture button dengan text 0/3
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

        function setupMirrorToggle() {
            const mirrorToggle = document.getElementById('mirrorToggle');
            if (mirrorToggle) {
                mirrorToggle.addEventListener('click', () => {
                    isMirrored = !isMirrored;
                    video.style.transform = isMirrored ? 'scaleX(-1)' : 'scaleX(1)';
                    mirrorToggle.textContent = `Mirror: ${isMirrored ? 'On' : 'Off'}`;
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

        function setupCountdownSelect() {
            const countdownSelect = document.getElementById('countdownSelect');
            if (countdownSelect) {
                countdownSelect.addEventListener('change', () => {
                    selectedCountdown = parseInt(countdownSelect.value);
                });
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
            }
        }

        function closeTestimoniModal() {
            if (testimoniModal) {
                testimoniModal.style.display = 'none';
            }
        }

        function submitTestimoniData() {
            if (selectedRating === 0) {
                alert('Mohon berikan rating terlebih dahulu! ⭐');
                return;
            }

            const name = testimoniName ? testimoniName.value.trim() : '';
            if (!name || name.length < 2) {
                alert('Mohon masukkan nama Anda (minimal 2 karakter)! 👤');
                testimoniName.focus();
                return;
            }

            const message = testimoniMessage ? testimoniMessage.value.trim() : '';
            if (!message || message.length < 10) {
                alert('Mohon tuliskan testimoni Anda (minimal 10 karakter)! 💬');
                testimoniMessage.focus();
                return;
            }

            if (!selectedEmoji) {
                alert('Mohon pilih emoji yang sesuai dengan pengalaman Anda! 😊');
                return;
            }

            const tokenElement = document.querySelector('meta[name="csrf-token"]');
            if (!tokenElement) {
                console.error('CSRF token not found');
                alert('Terjadi kesalahan sistem. Silakan refresh halaman.');
                return;
            }

            const token = tokenElement.getAttribute('content');
            const submitButton = document.getElementById('submitTestimoni');

            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Mengirim...';
                submitButton.classList.add('opacity-50');
            }

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
                        alert('Terima kasih atas testimoni Anda! 🙏✨');
                        closeTestimoniModal();
                        resetTestimoniForm();
                    } else {
                        alert(data.message || 'Gagal mengirim testimoni. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim testimoni. Silakan coba lagi. 🔄');
                })
                .finally(() => {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Kirim Testimoni';
                        submitButton.classList.remove('opacity-50');
                    }
                });
        }

        function resetTestimoniForm() {
            selectedRating = 0;
            selectedEmoji = '';

            const nameInput = document.getElementById('testimoniName');
            const messageInput = document.getElementById('testimoniMessage');
            const messageCounter = document.getElementById('messageCounter');

            if (nameInput) {
                nameInput.value = '';
                nameInput.classList.remove('error-input', 'valid-input');
            }

            if (messageInput) {
                messageInput.value = '';
                messageInput.classList.remove('error-input', 'valid-input');
            }

            if (messageCounter) {
                messageCounter.textContent = '0/500';
                messageCounter.style.color = '#6b7280';
            }

            const stars = starRating?.querySelectorAll('.star');
            if (stars) {
                stars.forEach(star => star.classList.remove('active'));
            }

            const emojis = emojiSelector?.querySelectorAll('.emoji-option');
            if (emojis) {
                emojis.forEach(emoji => emoji.classList.remove('selected'));
            }
        }

        function setupTestimoniEventListeners() {
            if (testimoniModalClose) {
                testimoniModalClose.addEventListener('click', closeTestimoniModal);
            }

            if (skipTestimoni) {
                skipTestimoni.addEventListener('click', closeTestimoniModal);
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

            // Fungsi untuk mendapatkan status pembayaran saat ini
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

                // Jika status adalah 'downloaded', tampilkan alert konfirmasi
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
                // Menggunakan confirm browser native
                const userConfirmed = confirm(
                    "Anda telah mendownload foto. Apakah Anda yakin ingin kembali ke menu utama?"
                );

                if (userConfirmed) {
                    // User memilih 'Yes/OK' - kembali ke menu utama
                    executeCloseModal();
                    setTimeout(() => {
                        redirectToMainMenu();
                    }, 400); // Delay sedikit untuk animasi close
                }
                // Jika user memilih 'No/Cancel', tidak melakukan apa-apa (tetap di halaman)
            }
        });

        function setupFloatingCameraToggle() {
            const floatingToggle = document.getElementById('floatingCameraToggle');
            if (floatingToggle) {
                floatingToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleCamera();
                });
                console.log('Floating camera toggle event listener added');
            } else {
                console.log('Floating camera toggle button not found');
            }
        }

        function updateFloatingCameraToggleButton() {
            const floatingToggle = document.getElementById('floatingCameraToggle');
            if (floatingToggle) {
                const isRearCamera = currentFacingMode === 'environment';
                floatingToggle.title = isRearCamera ? 'Switch to Front Camera' : 'Switch to Rear Camera';

                // Update icon berdasarkan kamera aktif
                const icon = ` <svg id="cameraIcon" class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>`;

                floatingToggle.innerHTML = icon;
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

        // Fungsi untuk redirect ke halaman utama dengan pesan
        function redirectToMainMenuWithMessage(message) {
            // Tampilkan pesan error sebelum redirect
            if (typeof toastr !== 'undefined') {
                toastr.error(message, 'Akses Ditolak');
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/';
                });
            } else {
                alert(message);
                window.location.href = '/';
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
                console.log('Initializing validation for paid frame');

                // Jalankan validasi untuk frame berbayar
                if (!validateBoothAccess()) {
                    return false;
                }

                if (!validateSingleSession()) {
                    return false;
                }
            } else {
                console.log('Initializing free frame - no validation required');
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
    </script>
</body>

</html>
