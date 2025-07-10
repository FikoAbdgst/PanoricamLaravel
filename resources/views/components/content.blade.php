<!-- resources/views/content.blade.php -->
<style>
    #previewCountdownOverlay {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: opacity 0.3s ease, background-color 0.2s ease;
        font-size: 3rem;
        color: white;
        display: none;
    }

    #previewCountdownOverlay.show {
        display: flex;
    }

    #previewCountdownOverlay.flash {
        background-color: rgba(255, 255, 255, 0.9);
        transition: background-color 0.2s ease;
    }

    #previewCameraModal {
        font-family: 'Poppins', sans-serif;
    }

    #previewVideo,
    #mobilePreviewVideo {
        background-color: #000;
        transform: scaleX(-1);
        /* Mirror the video preview */
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        /* Pastikan video ditampilkan sebagai block */
        -webkit-transform: scaleX(-1);
        /* Tambahkan vendor prefix untuk Safari */
        -webkit-backface-visibility: hidden;
        /* Perbaiki rendering di iOS */
        position: absolute;
        /* Pastikan video mengisi container */
        top: 0;
        left: 0;
    }

    #previewVideo[hidden],
    #mobilePreviewVideo[hidden] {
        display: none !important;
        /* Sembunyikan video jika gagal */
    }

    #previewFrameContainer {
        height: 100%;
        width: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #previewFrameImage {
        position: relative;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .watermark {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 10;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: rgba(255, 255, 255, 0.7);
        font-weight: bold;
        user-select: none;
    }

    .watermark-text {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .watermark-pattern {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: repeating-linear-gradient(45deg,
                rgba(255, 255, 255, 0.1),
                rgba(255, 255, 255, 0.1) 10px,
                transparent 10px,
                transparent 20px);
        opacity: 0.3;
    }

    #previewCaptureButton:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    #previewCountdownOverlay {
        animation: pulse 1s infinite;
    }

    #previewFrameImage img,
    #previewFrameImage svg,
    #previewFrameImage>div {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    #previewFrameContainer .photo-slot {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    #previewFrameContainer .photo-slot img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-slot-container {
        position: absolute;
        overflow: hidden;
    }

    .photo-slot {
        width: 100%;
        height: 100%;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .photo-slot img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .photo-slot img[src]:not([src=""]) {
        display: block;
    }

    #previewWatermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 10;
        opacity: 0.4;
        transition: opacity 1.5s ease;
        display: none;
    }

    #previewWatermark.show {
        display: flex;
    }

    #previewWatermark .watermark-content {
        background-color: rgba(155, 155, 155, 0.5);
        padding: 10px 20px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #previewWatermark .watermark-content span {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mobile-modal-container {
        transform: translateY(100%);
        transition: transform 0.3s ease-out;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 60;
    }

    .mobile-modal-container.show {
        transform: translateY(0);
    }

    .mobile-modal-container.hide {
        transform: translateY(100%);
    }

    @media (max-width: 768px) {
        #previewCameraModal .mobile-modal-container {
            display: block !important;
        }

        #previewCameraModal .hidden.md\\:block {
            display: none !important;
        }
    }

    body.modal-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
    }

    .modal-backdrop {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-backdrop.show {
        opacity: 1;
    }

    #mobilePreviewCountdownOverlay {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: opacity 0.3s ease, background-color 0.2s ease;
        font-size: 3rem;
        color: white;
        display: none;
    }

    #mobilePreviewCountdownOverlay.show {
        display: flex;
    }

    #mobilePreviewCountdownOverlay.flash {
        background-color: rgba(255, 255, 255, 0.9);
        transition: background-color 0.2s ease;
    }

    #mobilePreviewWatermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 10;
        opacity: 0.4;
        transition: opacity 1.5s ease;
        display: none;
    }

    #mobilePreviewWatermark.show {
        display: flex;
    }

    .frame-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
    }

    .frame-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .frame-card .frame-image-container {
        position: relative;
        height: 240px;
        background: linear-gradient(to bottom right, #f7f7f7, #fff1f1);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .frame-card:hover .frame-image-container {
        background: linear-gradient(to bottom right, #fff5f5, #ffebeb);
    }

    .frame-card .frame-image {
        max-height: 90%;
        max-width: 90%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }

    .frame-card:hover .frame-image {
        transform: scale(1.05);
    }

    .frame-card .frame-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .frame-card:hover .frame-overlay {
        opacity: 1;
    }

    .frame-card .preview-button {
        background-color: rgba(255, 255, 255, 0.95);
        color: #1f2937;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 9999px;
        transform: translateY(20px);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .frame-card:hover .preview-button {
        transform: translateY(0);
    }

    .frame-card .preview-button:hover {
        background-color: #BF3131;
        color: white;
    }

    .frame-card .card-content {
        padding: 16px;
        background: white;
    }

    .frame-card .frame-title {
        color: #1f2937;
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 8px;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .frame-card:hover .frame-title {
        color: #BF3131;
    }

    .frame-card .frame-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 8px;
    }

    .frame-card .category {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #4b5563;
        font-size: 0.75rem;
        background-color: #fef2f2;
        padding: 4px 8px;
        border-radius: 9999px;
        transition: all 0.3s ease;
    }

    .frame-card:hover .category {
        background-color: #fee2e2;
        color: #BF3131;
    }

    .frame-card .usage-count {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #6b7280;
        font-size: 0.75rem;
    }

    .frame-card .badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
        padding: 4px 10px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .frame-card .badge-free {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .frame-card .badge-premium {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .frame-card-skeleton {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .frame-card-skeleton .skeleton-image {
        height: 240px;
        background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    .frame-card-skeleton .skeleton-content {
        padding: 16px;
    }

    .frame-card-skeleton .skeleton-title {
        height: 20px;
        width: 70%;
        background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .frame-card-skeleton .skeleton-details {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
    }

    .frame-card-skeleton .skeleton-category {
        height: 20px;
        width: 40%;
        background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 9999px;
    }

    .frame-card-skeleton .skeleton-usage {
        height: 20px;
        width: 30%;
        background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 4px;
    }

    @keyframes shimmer {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }
</style>

<div class="py-16 bg-[#FEF3E2] content_section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 inline-block relative">
                <span class="bg-clip-text text-transparent bg-[#BF3131]">Frame Unggulan</span>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1/2 h-1 bg-[#BF3131] rounded-full">
                </div>
            </h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Frame paling populer yang banyak digunakan untuk momen
                spesial Anda</p>
        </div>

        @if ($topFrames->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-16">
                @foreach ($topFrames as $index => $frame)
                    <div class="frame-card group relative" data-frame-id="{{ $frame->id }}" data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}">
                        <div class="badge {{ $frame->isFree() ? 'badge-free' : 'badge-premium' }}">
                            @if ($frame->isFree())
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                GRATIS
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                {{ number_format($frame->price, 0, ',', '.') }} IDR
                            @endif
                        </div>

                        <div class="frame-image-container">
                            <div
                                class="absolute inset-0 flex items-center justify-center p-4 transition-transform duration-500 group-hover:scale-105">
                                @if ($frame->image_path)
                                    <img src="{{ asset('storage/' . $frame->image_path) }}" alt="{{ $frame->name }}"
                                        class="frame-image">
                                @else
                                    <div class="text-gray-400 text-5xl">🖼️</div>
                                @endif
                            </div>

                            <div class="frame-overlay">
                                <button class="preview-button" data-frame-id="{{ $frame->id }}">
                                    Preview
                                </button>
                            </div>
                        </div>

                        <div class="card-content ">
                            <div class="flex justify-between items-start">
                                <h3 class="frame-title">{{ $frame->name }}</h3>
                                <div class="category">
                                    <span>{{ $frame->category->icon }}</span>
                                    <span>{{ $frame->category->name }}</span>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 mt-2"></div>
                            <div class="frame-details absolute top-1 bg-red-600 py-2 px-3 rounded-xl">
                                <div class="usage-count text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="white"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                    </svg>
                                    <p class="text-white"> {{ $frame->used }}</p>
                                </div>
                            </div>

                        </div>
                        <div
                            class="absolute inset-0 rounded-xl bg-gradient-to-r from-red-500/20 to-amber-500/20 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300">
                        </div>
                    </div>
                @endforeach

                <div class="frame-card-skeleton hidden">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-content">
                        <div class="skeleton-title"></div>
                        <div class="skeleton-details">
                            <div class="skeleton-category"></div>
                            <div class="skeleton-usage"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-gradient-to-r from-red-50 to-red-50 rounded-2xl shadow-inner mb-16"
                data-aos="fade-up">
                <div class="inline-block text-7xl mb-6 animate-pulse">🖼️</div>
                <p class="text-xl text-gray-600 font-light">Belum ada frame unggulan saat ini.</p>
                <p class="mt-3 text-gray-500">Coba lagi nanti atau jelajahi kategori lainnya.</p>
            </div>
        @endif

        <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('frametemp') }}"
                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#BF3131] hover:bg-[#F16767] transition duration-300 shadow-md hover:shadow-lg">
                Mulai Mencoba
                <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</div>

<div id="previewCameraModal" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm modal-backdrop"></div>

    <div
        class="relative bg-white rounded-xl shadow-xl p-6 w-full max-w-4xl mx-4 hidden md:block animate-[modalFadeIn_0.3s]">
        <button
            class="modal-close absolute top-4 right-4 text-2xl text-gray-500 hover:text-black cursor-pointer">×</button>

        <h2 class="text-xl font-semibold mb-4 text-center">Frame Preview</h2>

        <div class="flex flex-row gap-6 justify-center items-center">
            <div class="w-3/5">
                <div class="relative bg-white rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                    <video id="previewVideo" autoplay muted playsinline class="w-full h-full object-cover"></video>
                    <div id="previewWatermark" class="hidden">
                        <div class="watermark-content">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10">
                        </div>
                    </div>
                    <div id="previewCountdownOverlay"
                        class="absolute inset-0 flex items-center justify-center text-6xl font-bold text-white/90">
                    </div>
                </div>

                <button id="previewCaptureButton"
                    class="mt-4 w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-colors">
                    📷 Start Session
                </button>
            </div>

            <div class="relative" style="width: 190px; height: 500px;">
                <div id="previewFrameContainer"
                    class="w-full h-full relative bg-transparent shadow-md overflow-hidden">
                    <div id="previewFrameImage" class="absolute inset-0 flex items-center justify-center bg-gray-100">
                        <p class="text-gray-400 text-center p-4">Frame akan muncul di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Modal - Perbaikan struktur -->
    <div
        class="relative bg-white rounded-t-xl shadow-xl w-full md:hidden mobile-modal-container max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 z-10 bg-white rounded-t-xl border-b border-gray-200">
            <div class="w-12 h-1.5 bg-gray-300 rounded-full mx-auto my-3"></div>
            <h2 class="text-xl font-semibold px-4 pb-3 text-center">Frame Preview</h2>
            <button
                class="modal-close absolute top-3 right-4 text-2xl text-gray-500 hover:text-black cursor-pointer">×</button>
        </div>

        <div class="p-4 flex flex-col gap-6">
            <div class="w-full">
                <div class="relative bg-white rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                    <video id="mobilePreviewVideo" autoplay muted playsinline
                        class="w-full h-full object-cover"></video>
                    <button id="mobileToggleCameraButton"
                        class="absolute top-4 right-4 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-all duration-300 backdrop-blur-sm">
                        <svg id="mobileCameraIcon" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                    <div id="mobilePreviewWatermark" class="hidden">
                        <div class="watermark-content">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10">
                        </div>
                    </div>
                    <div id="mobilePreviewCountdownOverlay"
                        class="absolute inset-0 flex items-center justify-center text-6xl font-bold text-white/90">
                    </div>
                </div>

                <button id="mobilePreviewCaptureButton"
                    class="mt-4 w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition-colors">
                    📷 Start Session
                </button>
            </div>

            <div class="w-full flex justify-center items-center pb-4">
                <div class="relative" style="width: 190px; height: 500px;">
                    <div id="mobilePreviewFrameContainer"
                        class="w-full h-full relative bg-transparent shadow-md overflow-hidden">
                        <div id="mobilePreviewFrameImage"
                            class="absolute inset-0 flex items-center justify-center bg-gray-100">
                            <p class="text-gray-400 text-center p-4">Frame akan muncul di sini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    let currentFacingMode = 'user';
    let isTogglingCamera = false;

    function toggleMobileCamera() {
        if (isTogglingCamera) return;

        isTogglingCamera = true;
        const toggleButton = document.getElementById('mobileToggleCameraButton');
        const cameraIcon = document.getElementById('mobileCameraIcon');
        const mobileVideo = document.getElementById('mobilePreviewVideo');

        toggleButton.disabled = true;
        cameraIcon.style.opacity = '0.5';

        // Stop existing stream
        if (window.stream) {
            window.stream.getTracks().forEach(track => track.stop());
            window.stream = null;
            mobileVideo.srcObject = null;
        }

        currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';

        const constraints = {
            video: {
                width: {
                    ideal: 1280
                },
                height: {
                    ideal: 720
                },
                aspectRatio: 4 / 3,
                facingMode: {
                    exact: currentFacingMode
                }
            }
        };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(stream => {
                window.stream = stream;
                mobileVideo.srcObject = stream;

                mobileVideo.onloadedmetadata = function() {
                    mobileVideo.play().catch(err => {
                        console.error('Error playing mobile video after toggle:', err);
                        handleCameraError(mobileVideo, document.getElementById(
                            'mobilePreviewCaptureButton'));
                    });
                    if (currentFacingMode === 'user') {
                        mobileVideo.classList.add('scale-x-[-1]');
                    } else {
                        mobileVideo.classList.remove('scale-x-[-1]');
                    }

                    toggleButton.disabled = false;
                    cameraIcon.style.opacity = '1';
                    isTogglingCamera = false;
                    console.log(`Camera switched to: ${currentFacingMode}`);
                };
            })
            .catch(err => {
                console.error('Error switching camera:', err);

                // Fallback to less strict constraints
                const fallbackConstraints = {
                    video: {
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        },
                        aspectRatio: 4 / 3,
                        facingMode: currentFacingMode
                    }
                };

                navigator.mediaDevices.getUserMedia(fallbackConstraints)
                    .then(stream => {
                        window.stream = stream;
                        mobileVideo.srcObject = stream;

                        mobileVideo.onloadedmetadata = function() {
                            mobileVideo.play().catch(err => {
                                console.error('Error playing mobile video after fallback:', err);
                                handleCameraError(mobileVideo, document.getElementById(
                                    'mobilePreviewCaptureButton'));
                            });
                            if (currentFacingMode === 'user') {
                                mobileVideo.classList.add('scale-x-[-1]');
                            } else {
                                mobileVideo.classList.remove('scale-x-[-1]');
                            }

                            toggleButton.disabled = false;
                            cameraIcon.style.opacity = '1';
                            isTogglingCamera = false;
                            console.log(`Fallback camera switched to: ${currentFacingMode}`);
                        };
                    })
                    .catch(fallbackErr => {
                        console.error('Fallback camera switch failed:', fallbackErr);
                        toastr.error(
                            'Tidak dapat mengganti kamera. Pastikan perangkat Anda mendukung kamera yang dipilih.'
                        );
                        currentFacingMode = currentFacingMode === 'user' ? 'environment' :
                            'user'; // Revert facing mode
                        toggleButton.disabled = false;
                        cameraIcon.style.opacity = '1';
                        isTogglingCamera = false;
                    });
            });
    }
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing frame cards...');
        setupFrameCards();

        document.querySelectorAll('.category-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const scrollPosition = window.scrollY;

                console.log('Category link clicked:', url);

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.querySelector('.content_section');

                        if (newContent) {
                            document.querySelector('.content_section').outerHTML =
                                newContent.outerHTML;
                            window.history.pushState({}, '', url);
                            window.scrollTo(0, scrollPosition);
                            attachCategoryListeners();
                            setupFrameCards();
                            console.log('Content updated, frame cards re-initialized');
                        }
                    })
                    .catch(error => console.error('Error fetching category:', error));
            });
        });

        window.addEventListener('popstate', function() {
            location.reload();
        });

        function attachCategoryListeners() {
            document.querySelectorAll('.category-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.href;
                    const scrollPosition = window.scrollY;

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.querySelector('.content_section');

                            if (newContent) {
                                document.querySelector('.content_section').outerHTML =
                                    newContent.outerHTML;
                                window.history.pushState({}, '', url);
                                window.scrollTo(0, scrollPosition);
                                attachCategoryListeners();
                                setupFrameCards();
                            }
                        });
                });
            });
        }

        if (!window.html2canvas) {
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
            script.async = true;
            document.head.appendChild(script);
            console.log('Loading html2canvas script...');
        }

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        window.showPremiumAlert = function(price) {
            toastr.warning(
                `Fitur ini masih maintenance`,
                'Fitur Premium', {
                    "timeOut": "5000",
                    "closeButton": true,
                    "positionClass": "toast-top-center",
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp"
                }
            );
        };
    });

    function setupFrameCards() {
        const frameCards = document.querySelectorAll('.frame-card');
        console.log(`Found ${frameCards.length} frame cards`);

        frameCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.preview-button')) return;

                const frameId = this.dataset.frameId;
                console.log('Frame card clicked for frame ID:', frameId);
                openPreviewCameraModal(e, frameId);
            });

            const previewBtn = card.querySelector('.preview-button');
            if (previewBtn) {
                previewBtn.removeEventListener('click', handlePreviewButtonClick);
                previewBtn.addEventListener('click', handlePreviewButtonClick);
            }
        });
    }

    function handlePreviewButtonClick(e) {
        e.preventDefault();
        e.stopPropagation();

        const frameId = this.dataset.frameId;
        console.log('Preview button clicked for frame ID:', frameId);
        openPreviewCameraModal(e, frameId);
    }

    function openPreviewCameraModal(e, frameId) {
        e.preventDefault();
        e.stopPropagation();

        const scrollPosition = window.scrollY;
        console.log('openPreviewCameraModal called, scroll position saved:', scrollPosition);

        const modal = document.getElementById('previewCameraModal');
        if (!modal) {
            console.error('Modal element not found!');
            return;
        }

        resetModalState();

        // Perbaikan: Pastikan modal ditampilkan terlebih dahulu
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        const mobileModalContainer = modal.querySelector('.mobile-modal-container');
        const modalBackdrop = modal.querySelector('.modal-backdrop');

        // Perbaikan: Tambahkan class show ke backdrop
        if (modalBackdrop) {
            modalBackdrop.classList.add('show');
        }

        // Perbaikan: Untuk mobile, pastikan container ditampilkan dengan benar
        const isMobile = window.innerWidth < 768;

        if (isMobile && mobileModalContainer) {
            // Reset transform dan pastikan visibility
            mobileModalContainer.style.display = 'block';
            mobileModalContainer.classList.remove('hide');

            // Gunakan requestAnimationFrame untuk memastikan DOM sudah siap
            requestAnimationFrame(() => {
                mobileModalContainer.classList.add('show');
                console.log('Mobile modal container shown');
            });
        }

        const video = document.getElementById('previewVideo');
        const mobileVideo = document.getElementById('mobilePreviewVideo');
        const previewFrameContainer = document.getElementById('previewFrameContainer');
        const previewFrameImage = document.getElementById('previewFrameImage');
        const mobilePreviewFrameContainer = document.getElementById('mobilePreviewFrameContainer');
        const mobilePreviewFrameImage = document.getElementById('mobilePreviewFrameImage');
        const captureButton = document.getElementById('previewCaptureButton');
        const mobileCaptureButton = document.getElementById('mobilePreviewCaptureButton');

        console.log('Modal elements found:', {
            modal: !!modal,
            mobileModalContainer: !!mobileModalContainer,
            mobileVideo: !!mobileVideo,
            mobilePreviewFrameImage: !!mobilePreviewFrameImage
        });

        if (frameId) {
            modal.setAttribute('data-frame-id', frameId);
            window.currentFrameId = frameId;

            const loadingContent =
                '<div class="flex items-center justify-center w-full h-full"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500"></div></div>';
            if (previewFrameImage) previewFrameImage.innerHTML = loadingContent;
            if (mobilePreviewFrameImage) mobilePreviewFrameImage.innerHTML = loadingContent;

            fetchFrameDetails(frameId);

            fetch(`/get-frame-template/${frameId}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.text();
                })
                .then(html => {
                    if (previewFrameImage) previewFrameImage.innerHTML = html;
                    if (mobilePreviewFrameImage) mobilePreviewFrameImage.innerHTML = html;
                    initializePhotoSlots(previewFrameImage);
                    initializePhotoSlots(mobilePreviewFrameImage, true);
                    console.log('Frame template loaded successfully');
                })
                .catch(error => {
                    console.error('Error loading frame template:', error);
                    const errorContent = `
                    <div class="flex flex-col items-center justify-center w-full h-full text-red-500">
                        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-center">Failed to load frame template.</p>
                    </div>
                `;
                    if (previewFrameImage) previewFrameImage.innerHTML = errorContent;
                    if (mobilePreviewFrameImage) mobilePreviewFrameImage.innerHTML = errorContent;
                    createDummySlots(previewFrameImage);
                    createDummySlots(mobilePreviewFrameImage, true);
                });
        }

        // Perbaikan: Inisialisasi kamera untuk kedua video element
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            const isMobile = window.innerWidth <= 768;
            const videoConstraints = {
                video: {
                    width: {
                        ideal: 640
                    },
                    height: {
                        ideal: 480
                    },
                    aspectRatio: 4 / 3,
                    facingMode: isMobile ? {
                        ideal: currentFacingMode
                    } : 'user'
                }
            };

            navigator.mediaDevices.getUserMedia(videoConstraints)
                .then(stream => {
                    window.stream = stream;
                    video.srcObject = stream;
                    mobileVideo.srcObject = stream;

                    video.onloadedmetadata = function() {
                        video.play().catch(err => {
                            console.error('Error playing video:', err);
                            handleCameraError(video, captureButton);
                        });
                    };

                    mobileVideo.onloadedmetadata = function() {
                        mobileVideo.play().catch(err => {
                            console.error('Error playing mobile video:', err);
                            handleCameraError(mobileVideo, mobileCaptureButton);
                        });
                        if (isMobile && currentFacingMode === 'user') {
                            mobileVideo.classList.add('scale-x-[-1]');
                        } else {
                            mobileVideo.classList.remove('scale-x-[-1]');
                        }
                    };

                    console.log('Webcam stream initialized with constraints:', videoConstraints);
                })
                .catch(err => {
                    console.error('Error accessing webcam:', err);
                    handleCameraError(video, captureButton);
                    handleCameraError(mobileVideo, mobileCaptureButton);
                    toastr.error('Gagal mengakses kamera. Pastikan izin kamera diaktifkan dan coba lagi.');
                });
        }

        // Add event listener for the toggle button
        const mobileToggleButton = document.getElementById('mobileToggleCameraButton');
        if (mobileToggleButton) {
            mobileToggleButton.removeEventListener('click', toggleMobileCamera);
            mobileToggleButton.addEventListener('click', toggleMobileCamera);
        }


        // Event listeners
        const modalCloseButtons = modal.querySelectorAll('.modal-close');
        modalCloseButtons.forEach(btn => {
            btn.removeEventListener('click', closePreviewCameraModal);
            btn.addEventListener('click', () => closePreviewCameraModal(scrollPosition));
        });

        window.removeEventListener('click', handleModalBackdropClick);
        window.addEventListener('click', (e) => handleModalBackdropClick(e, scrollPosition));

        if (captureButton) captureButton.addEventListener('click', () => startPhotoSession(false));
        if (mobileCaptureButton) mobileCaptureButton.addEventListener('click', () => startPhotoSession(true));

        // Perbaikan: Body positioning untuk mobile
        document.body.style.position = 'fixed';
        document.body.style.top = `-${scrollPosition}px`;
        document.body.style.width = '100%';

        console.log('Modal opened successfully');
    }

    function handleModalBackdropClick(e, scrollPosition) {
        const modal = document.getElementById('previewCameraModal');
        if (e.target === modal || e.target.classList.contains('modal-backdrop')) {
            closePreviewCameraModal(scrollPosition);
        }
    }

    function enableDragToClose(element) {
        if (!element) return;
        let startY = 0;
        let currentY = 0;

        element.addEventListener('touchstart', function(e) {
            startY = e.touches[0].clientY;
        });

        element.addEventListener('touchmove', function(e) {
            currentY = e.touches[0].clientY;
            const dragDistance = currentY - startY;
            if (dragDistance > 0) {
                element.style.transform = `translateY(${dragDistance}px)`;
            }
        });

        element.addEventListener('touchend', function() {
            const dragDistance = currentY - startY;
            if (dragDistance > 100) {
                closePreviewCameraModal();
            } else {
                element.style.transform = '';
            }
        });
    }

    function closePreviewCameraModal(scrollPosition) {
        const modal = document.getElementById('previewCameraModal');
        const mobileModalContainer = modal.querySelector('.mobile-modal-container');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const video = document.getElementById('previewVideo');
        const mobileVideo = document.getElementById('mobilePreviewVideo');
        const desktopModal = modal.querySelector('.hidden.md\\:block');

        // Perbaikan: Handle mobile modal close animation
        if (mobileModalContainer) {
            mobileModalContainer.classList.remove('show');
            mobileModalContainer.classList.add('hide');
        }

        if (desktopModal) {
            desktopModal.style.opacity = '0';
            desktopModal.style.transform = 'translateY(-30px)';
            desktopModal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }

        if (modalBackdrop) {
            modalBackdrop.classList.remove('show');
        }

        // Cleanup camera stream
        if (window.stream) {
            const tracks = window.stream.getTracks();
            tracks.forEach(track => track.stop());
            if (video && video.srcObject) video.srcObject = null;
            if (mobileVideo && mobileVideo.srcObject) mobileVideo.srcObject = null;
            window.stream = null;
        }

        // Cleanup event listeners
        const captureButton = document.getElementById('previewCaptureButton');
        const mobileCaptureButton = document.getElementById('mobilePreviewCaptureButton');
        if (captureButton) captureButton.removeEventListener('click', startPhotoSession);
        if (mobileCaptureButton) mobileCaptureButton.removeEventListener('click', startPhotoSession);

        window.removeEventListener('click', handleModalBackdropClick);

        resetModalState();

        // Restore body positioning
        document.body.classList.remove('modal-open');
        document.body.style.position = '';
        document.body.style.top = '';
        window.scrollTo(0, scrollPosition);

        // Hide modal after animation
        setTimeout(() => {
            modal.style.display = 'none';
            if (mobileModalContainer) {
                mobileModalContainer.classList.remove('hide');
                mobileModalContainer.style.display = '';
            }
            if (desktopModal) {
                desktopModal.style.opacity = '';
                desktopModal.style.transform = '';
            }
            console.log('Modal closed and scroll position restored to:', scrollPosition);
        }, 300);
    }

    function resetModalState() {
        const countdownOverlay = document.getElementById('previewCountdownOverlay');
        const captureButton = document.getElementById('previewCaptureButton');
        const watermark = document.getElementById('previewWatermark');
        const mobileCountdownOverlay = document.getElementById('mobilePreviewCountdownOverlay');
        const mobileCaptureButton = document.getElementById('mobilePreviewCaptureButton');
        const mobileWatermark = document.getElementById('mobilePreviewWatermark');
        const previewFrameImage = document.getElementById('previewFrameImage');
        const mobilePreviewFrameImage = document.getElementById('mobilePreviewFrameImage');

        window.photoSlots = [];
        window.mobilePhotoSlots = [];

        currentFacingMode = 'user';
        isTogglingCamera = false;

        const toggleButton = document.getElementById('mobileToggleCameraButton');
        const cameraIcon = document.getElementById('mobileCameraIcon');
        if (toggleButton) {
            toggleButton.disabled = false;
            toggleButton.removeEventListener('click', toggleMobileCamera);
        }
        if (cameraIcon) {
            cameraIcon.style.opacity = '1';
        }

        if (previewFrameImage) {
            const slots = previewFrameImage.querySelectorAll('.photo-slot');
            slots.forEach(slot => {
                const img = slot.querySelector('img');
                if (img) {
                    img.src = '';
                    img.style.display = 'none';
                }
                const slotWatermark = slot.querySelector('.slot-watermark');
                if (slotWatermark) slotWatermark.remove();
            });
        }
        if (mobilePreviewFrameImage) {
            const mobileSlots = mobilePreviewFrameImage.querySelectorAll('.photo-slot');
            mobileSlots.forEach(slot => {
                const img = slot.querySelector('img');
                if (img) {
                    img.src = '';
                    img.style.display = 'none';
                }
                const slotWatermark = slot.querySelector('.slot-watermark');
                if (slotWatermark) slotWatermark.remove();
            });
        }

        const resetElements = (countdown, capture, mark) => {
            if (countdown) {
                countdown.textContent = '';
                countdown.style.display = 'none';
                countdown.style.backgroundColor = 'transparent';
                countdown.classList.remove('show', 'flash');
            }
            if (capture) {
                capture.textContent = "📷 Start Session";
                capture.disabled = false;
                capture.removeEventListener('click', startPhotoSession);
            }
            if (mark) {
                mark.classList.add('hidden');
                mark.classList.remove('show');
            }
        };

        resetElements(countdownOverlay, captureButton, watermark);
        resetElements(mobileCountdownOverlay, mobileCaptureButton, mobileWatermark);

        if (window.timer) {
            clearInterval(window.timer);
            window.timer = null;
        }

        if (previewFrameImage) {
            previewFrameImage.innerHTML = '<p class="text-gray-400 text-center p-4">Frame akan muncul di sini</p>';
        }
        if (mobilePreviewFrameImage) {
            mobilePreviewFrameImage.innerHTML =
                '<p class="text-gray-400 text-center p-4">Frame akan muncul di sini</p>';
        }

        console.log('Modal state reset');
    }

    function createDummySlots(container, isMobile = false) {
        for (let i = 0; i < 3; i++) {
            const dummySlot = document.createElement('div');
            dummySlot.className = 'photo-slot';
            dummySlot.style.width = '100px';
            dummySlot.style.height = '100px';
            dummySlot.style.position = 'absolute';
            dummySlot.style.top = `${25 + (i * 30)}%`;
            dummySlot.style.left = '50%';
            dummySlot.style.transform = 'translate(-50%, -50%)';
            dummySlot.style.backgroundColor = 'rgba(0,0,0,0.2)';
            container.appendChild(dummySlot);

            const img = document.createElement('img');
            dummySlot.appendChild(img);

            if (isMobile) {
                if (!window.mobilePhotoSlots) window.mobilePhotoSlots = [];
                window.mobilePhotoSlots.push(img);
            } else {
                if (!window.photoSlots) window.photoSlots = [];
                window.photoSlots.push(img);
            }
        }
    }

    function initializePhotoSlots(frameElement, isMobile = false) {
        console.log(`Initializing photo slots for ${isMobile ? 'mobile' : 'desktop'}`);

        if (isMobile) {
            window.mobilePhotoSlots = [];
        } else {
            window.photoSlots = [];
        }

        // Remove existing slots
        const existingSlots = frameElement.querySelectorAll('.photo-slot');
        existingSlots.forEach(slot => slot.remove());

        // Perbaikan: Posisi slot yang lebih presisi sesuai dengan frame template
        const slotPositions = [{
                top: '16%',
                left: '50%',
                width: '150px',
                height: '110px'
            },
            {
                top: '43%',
                left: '50%',
                width: '150px',
                height: '110px'
            },
            {
                top: '69%',
                left: '50%',
                width: '150px',
                height: '110px'
            },
        ];

        for (let i = 0; i < 3; i++) {
            const photoSlot = document.createElement('div');
            photoSlot.className = 'photo-slot';
            photoSlot.style.cssText = `
                width: ${slotPositions[i].width};
                height: ${slotPositions[i].height};
                position: absolute;
                top: ${slotPositions[i].top};
                left: ${slotPositions[i].left};
                transform: translate(-50%, -50%);
                background-color: #f3f4f6;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                z-index: 10;
            `;

            const img = document.createElement('img');
            img.style.cssText = `
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: none;
                border-radius: 6px;
            `;
            photoSlot.appendChild(img);

            frameElement.appendChild(photoSlot);

            if (isMobile) {
                if (!window.mobilePhotoSlots) window.mobilePhotoSlots = [];
                window.mobilePhotoSlots.push(img);
            } else {
                if (!window.photoSlots) window.photoSlots = [];
                window.photoSlots.push(img);
            }
        }

        console.log(
            `Photo slots initialized: ${isMobile ? window.mobilePhotoSlots?.length : window.photoSlots?.length} slots`
        );
    }

    function startPhotoSession(isMobile = false) {
        const video = isMobile ? document.getElementById('mobilePreviewVideo') : document.getElementById(
            'previewVideo');
        const captureButton = isMobile ? document.getElementById('mobilePreviewCaptureButton') : document
            .getElementById('previewCaptureButton');
        const countdownOverlay = isMobile ? document.getElementById('mobilePreviewCountdownOverlay') : document
            .getElementById('previewCountdownOverlay');
        const photoSlots = isMobile ? window.mobilePhotoSlots : window.photoSlots;

        if (window.timer) {
            clearInterval(window.timer);
            window.timer = null;
        }

        if (photoSlots) {
            photoSlots.forEach(img => {
                img.src = '';
                img.style.display = 'none';
                const slotParent = img.parentElement;
                const slotWatermark = slotParent.querySelector('.slot-watermark');
                if (slotWatermark) slotWatermark.remove();
            });
        }

        captureButton.disabled = true;
        captureButton.textContent = "Sedang mengambil foto...";

        let photosLeft = 3;
        let currentPhoto = 0;

        function startCountdown() {
            let countdown = 3;
            countdownOverlay.textContent = countdown;
            countdownOverlay.style.display = 'flex';
            countdownOverlay.classList.add('show');
            countdownOverlay.style.backgroundColor = 'transparent';

            window.timer = setInterval(() => {
                countdown--;

                if (countdown > 0) {
                    countdownOverlay.textContent = countdown;
                } else if (countdown === 0) {
                    countdownOverlay.textContent = 'Snap!';
                } else {
                    takePhoto(currentPhoto, isMobile);
                    currentPhoto++;
                    photosLeft--;

                    clearInterval(window.timer);
                    window.timer = null;

                    if (photosLeft > 0) {
                        setTimeout(startCountdown, 500);
                    } else {
                        countdownOverlay.style.display = 'none';
                        countdownOverlay.classList.remove('show');
                        captureButton.textContent = "Selesai! Klik untuk ulang";
                        captureButton.disabled = false;
                    }
                }
            }, 1000);
        }

        startCountdown();
    }

    function takePhoto(slotIndex, isMobile = false) {
        const video = isMobile ? document.getElementById('mobilePreviewVideo') : document.getElementById(
            'previewVideo');
        const countdownOverlay = isMobile ? document.getElementById('mobilePreviewCountdownOverlay') : document
            .getElementById('previewCountdownOverlay');
        const watermark = isMobile ? document.getElementById('mobilePreviewWatermark') : document.getElementById(
            'previewWatermark');
        const previewCameraModal = document.getElementById('previewCameraModal');
        const frameId = previewCameraModal.getAttribute('data-frame-id');
        const photoSlots = isMobile ? window.mobilePhotoSlots : window.photoSlots;

        countdownOverlay.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
        countdownOverlay.textContent = '';
        countdownOverlay.classList.add('flash');

        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');

        if (isMobile && currentFacingMode === 'user') {
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            ctx.setTransform(1, 0, 0, 1, 0, 0);
        } else if (!isMobile) {
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            ctx.setTransform(1, 0, 0, 1, 0, 0);
        } else {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        }


        const addWatermark = () => {
            return new Promise((resolve) => {
                if (watermark && watermark.classList.contains('show')) {
                    ctx.save();
                    ctx.translate(canvas.width / 2, canvas.height / 2);
                    ctx.globalAlpha = 0.4;

                    const logo = new Image();
                    logo.src = '{{ asset('logo.png') }}';
                    logo.onload = () => {
                        ctx.drawImage(logo, -60, -20, 140, 80);
                        ctx.restore();
                        resolve();
                    };
                    logo.onerror = () => {
                        console.error('Failed to load watermark logo');
                        ctx.restore();
                        resolve();
                    };
                } else {
                    resolve();
                }
            });
        };

        addWatermark().then(() => {
            const photoDataUrl = canvas.toDataURL('image/jpeg');

            if (photoSlots && photoSlots[slotIndex]) {
                const img = photoSlots[slotIndex];
                img.src = photoDataUrl;
                img.style.display = 'block';

                if (watermark && watermark.classList.contains('show')) {
                    const slotParent = img.parentElement;
                    let watermarkElem = slotParent.querySelector('.slot-watermark');

                    if (!watermarkElem) {
                        watermarkElem = document.createElement('div');
                        watermarkElem.className = 'slot-watermark';
                        watermarkElem.style.position = 'absolute';
                        watermarkElem.style.top = '50%';
                        watermarkElem.style.left = '50%';
                        watermarkElem.style.transform = 'translate(-50%, -50%)';
                        watermarkElem.style.pointerEvents = 'none';
                        watermarkElem.style.zIndex = '10';
                        watermarkElem.style.opacity = '0.4';

                        const watermarkContent = document.createElement('div');
                        watermarkContent.style.display = 'flex';
                        watermarkContent.style.alignItems = 'center';
                        watermarkContent.style.justifyContent = 'center';
                        watermarkContent.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
                        watermarkContent.style.padding = '5px 10px';
                        watermarkContent.style.borderRadius = '8px';
                        watermarkContent.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';

                        const watermarkImg = document.createElement('img');
                        watermarkImg.src = '{{ asset('logo.png') }}';
                        watermarkImg.style.height = '30px';
                        watermarkImg.style.width = 'auto';

                        watermarkContent.appendChild(watermarkImg);
                        watermarkElem.appendChild(watermarkContent);
                        slotParent.appendChild(watermarkElem);
                    } else {
                        watermarkElem.style.display = 'block';
                    }
                }
            }

            setTimeout(() => {
                countdownOverlay.style.backgroundColor = 'transparent';
                countdownOverlay.textContent = '';
            }, 200);
        });

    }

    function fetchFrameDetails(frameId) {
        console.log('Fetching frame details for ID:', frameId);
        return fetch(`/get-frame-status/${frameId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                const watermark = document.getElementById('previewWatermark');
                const mobileWatermark = document.getElementById('mobilePreviewWatermark');

                const applyWatermarkVisibility = (element) => {
                    if (element) {
                        if (data.price > 0) {
                            element.classList.add('show');
                            element.classList.remove('hidden');
                        } else {
                            element.classList.add('hidden');
                            element.classList.remove('show');
                        }
                    }
                };

                applyWatermarkVisibility(watermark);
                applyWatermarkVisibility(mobileWatermark);
                console.log('Frame status fetched:', data);

                return data;
            })
            .catch(error => {
                console.error('Error fetching frame status:', error);
                const watermark = document.getElementById('previewWatermark');
                const mobileWatermark = document.getElementById('mobilePreviewWatermark');

                if (watermark) {
                    watermark.classList.add('hidden');
                    watermark.classList.remove('show');
                }
                if (mobileWatermark) {
                    mobileWatermark.classList.add('hidden');
                    mobileWatermark.classList.remove('show');
                }
                return null;
            });
    }

    function handleCameraError(video, captureButton) {
        if (video) {
            video.style.display = 'none';
            const parent = video.parentElement;
            let errorMessage = parent.querySelector('.camera-error');
            if (!errorMessage) {
                errorMessage = document.createElement('div');
                errorMessage.className =
                    'camera-error flex flex-col items-center justify-center w-full h-full text-red-500 text-center p-4';
                errorMessage.innerHTML = `
                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <p>Gagal mengakses kamera. Silakan periksa izin kamera di pengaturan browser atau coba perangkat lain.</p>
            `;
                parent.appendChild(errorMessage);
            }
        }
        if (captureButton) {
            captureButton.disabled = true;
            captureButton.textContent = 'Kamera Tidak Tersedia';
        }
    }
</script>
