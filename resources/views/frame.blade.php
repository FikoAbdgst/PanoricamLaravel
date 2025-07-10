@extends('layouts.app')

@section('hero_section')
    <style>
        /* AOS Animation Customizations */
        [data-aos] {
            transition-property: transform, opacity;
        }

        [data-aos] {
            transition-property: transform, opacity, filter;
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        /* Custom animations for frames */
        [data-aos="frame-fade-up"] {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            filter: blur(2px);
            transition-delay: calc(var(--aos-order) * 100ms);
        }

        [data-aos="frame-fade-up"].aos-animate {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }

        /* Category animations */
        [data-aos="category-zoom"] {
            opacity: 0;
            transform: scale(0.8);
            transition-delay: calc(var(--aos-order) * 50ms);
        }

        [data-aos="category-zoom"].aos-animate {
            opacity: 1;
            transform: scale(1);
        }

        /* Title animation */
        [data-aos="title-fade"] {
            opacity: 0;
            transform: translateY(-20px);
        }

        [data-aos="title-fade"].aos-animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Underline animation */
        [data-aos="underline-expand"] {
            opacity: 0;
            transform: scaleX(0);
            transform-origin: left center;
        }

        [data-aos="underline-expand"].aos-animate {
            opacity: 1;
            transform: scaleX(1);
        }

        [data-aos="zoom-in"] {
            opacity: 0;
            transform: scale(0.9);
            transition-property: transform, opacity;
        }

        [data-aos="zoom-in"].aos-animate {
            opacity: 1;
            transform: scale(1);
        }

        [data-aos="fade-right"] {
            opacity: 0;
            transform: translateX(-20px);
        }

        [data-aos="fade-right"].aos-animate {
            opacity: 1;
            transform: translateX(0);
        }

        /* Delay classes */
        .aos-delay-50 {
            transition-delay: 50ms;
        }

        .aos-delay-100 {
            transition-delay: 100ms;
        }

        .aos-delay-150 {
            transition-delay: 150ms;
        }

        .aos-delay-200 {
            transition-delay: 200ms;
        }

        /* Add more delay classes as needed */
        #acceptModal,
        #rejectModal {
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            overflow: hidden;
        }

        #acceptModal.show,
        #rejectModal.show {
            display: flex;
        }

        #acceptModal .modal-backdrop,
        #rejectModal .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #acceptModal .modal-backdrop.show,
        #rejectModal .modal-backdrop.show {
            opacity: 1;
        }

        #acceptModal .modal-content,
        #rejectModal .modal-content {
            position: relative;
            background: white;
            border-radius: 1rem;
            max-width: 32rem;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(0);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #acceptModal .modal-content.hide,
        #rejectModal .modal-content.hide {
            transform: translateY(100%);
            opacity: 0;
        }

        /* Tambahkan di bagian style Anda */
        #qrisModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        #qrisModal.show {
            display: flex;
        }

        #qrisModalContent {
            position: relative;
            background: white;
            border-radius: 1rem;
            max-width: 90%;
            max-height: 90vh;
            padding: 1rem;
        }

        #qrisModalImg {
            max-width: 100%;
            max-height: 80vh;
            display: block;
            margin: 0 auto;
        }



        #qrisContainer {
            cursor: pointer;
            transition: transform 0.2s;
        }

        #qrisContainer:hover {
            transform: scale(1.02);
        }

        /* Please Wait Modal Styles */
        #pleaseWaitModal {
            display: none;
            /* Initially hidden */
            align-items: center;
            justify-content: center;
            z-index: 60;
            /* Higher z-index to ensure it’s above other modals */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            overflow: hidden;
            /* Prevent scrolling */
        }

        #pleaseWaitModal.show {
            display: flex;
            /* Show modal when active */
        }

        #pleaseWaitModal .modal-content {
            position: relative;
            background: white;
            border-radius: 1rem;
            max-width: 32rem;
            width: 90%;
            /* Responsive width */
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(0);
            transition: transform 0.3s ease, opacity 0.3s ease;
            overflow: hidden;
            /* Prevent scrolling within modal */
        }



        /* Mobile-specific adjustments */
        @media (max-width: 640px) {
            #pleaseWaitModal .modal-content {
                width: 95%;
                max-height: 80vh;
                /* Limit height for mobile */
            }
        }

        /* Payment Modal Styles */
        #paymentModal {
            display: none;
            /* Initially hidden */
            align-items: center;
            justify-content: center;
            z-index: 50;
            overflow: hidden;
            /* Prevent modal itself from scrolling */
        }

        #paymentModal.show {
            display: flex;
            /* Show modal with flex */
        }

        #paymentModal .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Semi-transparent black */
            backdrop-filter: blur(4px);
            /* Optional: slight blur for effect */
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #paymentModal .modal-backdrop.show {
            opacity: 1;
        }

        #paymentModal .modal-content {
            position: relative;
            background: white;
            border-radius: 1rem;
            max-width: 32rem;
            /* max-w-lg */
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(0);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #paymentModal .modal-content.hide {
            transform: translateY(100%);
            opacity: 0;
        }

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }



        /* Mobile-specific modal styles */
        @media (max-width: 640px) {
            #paymentModal {
                align-items: center;
                justify-content: center;
            }

            #paymentModal .modal-content {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 1rem;
                max-height: 95vh;
                width: 90%;
                margin: 0;
            }
        }

        /* Drag handle for mobile */
        .modal-drag-handle {
            width: 3rem;
            height: 0.375rem;
            background-color: #d1d5db;
            border-radius: 9999px;
            margin: 0.75rem auto;
            cursor: grab;
        }

        /* Preview Modal Styles */
        #previewCameraModal {
            font-family: 'Poppins', sans-serif;
        }

        #previewVideo,
        #mobilePreviewVideo {
            background-color: #000;
        }

        #previewFrameContainer,
        #mobilePreviewFrameContainer {
            height: 100%;
            width: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #previewFrameImage,
        #mobilePreviewFrameImage {
            position: relative;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #previewFrameImage img,
        #previewFrameImage svg,
        #previewFrameImage>div,
        #mobilePreviewFrameImage img,
        #mobilePreviewFrameImage svg,
        #mobilePlusFrameImage>div {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .photo-slot-container {
            position: absolute;
            overflow: hidden;
        }

        .photo-slot {
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .photo-slot img {
            border-radius: 6px;
        }


        .photo-slot img[src]:not([src=""]) {
            display: block;
        }

        #previewWatermark,
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

        #previewWatermark.show,
        #mobilePreviewWatermark.show {
            display: flex;
        }

        #previewWatermark .watermark-content,
        #mobilePreviewWatermark .watermark-content {
            background-color: rgba(155, 155, 155, 0.5);
            padding: 10px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #previewWatermark .watermark-content span,
        #mobilePreviewWatermark .watermark-content span {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
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

        #previewCountdownOverlay,
        #mobilePreviewCountdownOverlay {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease, background-color 0.2s ease;
            font-size: 3rem;
            color: white;
            display: none;
        }

        #previewCountdownOverlay.show,
        #mobilePreviewCountdownOverlay.show {
            display: flex;
        }

        #previewCountdownOverlay.flash,
        #mobilePreviewCountdownOverlay.flash {
            background-color: rgba(255, 255, 255, 0.9);
            transition: background-color 0.2s ease;
        }

        #previewCaptureButton:disabled,
        #mobilePreviewCaptureButton:disabled {
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

        #previewCountdownOverlay,
        #mobilePreviewCountdownOverlay {
            animation: pulse 1s infinite;
        }

        /* Modal Animation */
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
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
            height: 95vh;
            max-height: 95vh;
        }

        .mobile-modal-container.show {
            transform: translateY(0);
        }

        .mobile-modal-container.hide {
            transform: translateY(100%);
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

        /* Category Button Styles (Desktop) - UPDATED */
        .category-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            /* Increased from 8px */
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-btn:hover {
            transform: translateY(-2px);
        }

        .category-icon {
            width: 64px;
            /* Increased from 48px */
            height: 64px;
            /* Increased from 48px */
            border-radius: 16px;
            /* Increased from 12px */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 2px solid transparent;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-icon:hover {
            background-color: #fff5f5;
            border-color: #fed7d7;
            transform: translateY(-2px);
        }

        .category-icon.active {
            background-color: #BF3131;
            border-color: #BF3131;
            color: white;
            width: 72px;
            /* Increased from 56px */
            height: 72px;
            /* Increased from 56px */
            transform: scale(1.1);
        }

        .category-icon.active span,
        .category-icon-mobile.active span {
            filter: none !important;
            text-shadow: 0 0 15px white;
            /* Ensures the original color is preserved */
        }

        .category-icon span {
            font-size: 24px;
            /* Increased from 18px */
        }

        .category-label {
            font-size: 14px;
            /* Increased from 12px */
            font-weight: 500;
            color: #6b7280;
            transition: color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-btn:hover .category-label {
            color: #BF3131;
        }

        .category-btn .category-icon.active+.category-label {
            color: #BF3131;
            font-weight: 600;
            font-size: 15px;
            /* Increased from 13px */
        }

        .filter-btn,
        .rating-filter-btn,
        .popular-filter-btn,
        .default-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
            background-color: white;
            color: #6b7280;
        }

        .filter-btn:hover,
        .rating-filter-btn:hover,
        .popular-filter-btn:hover,
        .default-filter-btn:hover {
            background-color: #fff5f5;
            border-color: #fed7d7;
            color: #BF3131;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(191, 49, 49, 0.15);
        }

        .filter-btn.active,
        .rating-filter-btn.active,
        .popular-filter-btn.active,
        .default-filter-btn.active {
            background-color: #BF3131;
            border-color: #BF3131;
            color: white;
        }

        .filter-btn.active svg,
        .rating-filter-btn.active svg,
        .popular-filter-btn.active svg,
        .default-filter-btn.active svg {
            color: white;
        }

        /* Mobile Filter Button Styles */
        .mobile-filter-btn,
        .mobile-rating-filter-btn,
        .mobile-popular-filter-btn,
        .mobile-default-filter-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
            background-color: white;
            color: #6b7280;
        }

        .mobile-filter-btn:hover,
        .mobile-rating-filter-btn:hover,
        .mobile-popular-filter-btn:hover,
        .mobile-default-filter-btn:hover {
            background-color: #fff5f5;
            border-color: #fed7d7;
            color: #BF3131;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(191, 49, 49, 0.15);
        }

        .mobile-filter-btn.active,
        .mobile-rating-filter-btn.active,
        .mobile-popular-filter-btn.active,
        .mobile-default-filter-btn.active {
            background-color: #BF3131;
            border-color: #BF3131;
            color: white;
        }

        .mobile-filter-btn.active svg,
        .mobile-rating-filter-btn.active svg,
        .mobile-popular-filter-btn.active svg,
        .mobile-default-filter-btn.active svg {
            color: white;
        }



        /* Category Scroll (Desktop) */
        .category-scroll-desktop {
            display: flex;
            overflow-x: auto;
            gap: 30px;
            padding: 20px 40px;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
        }

        .category-scroll-desktop::-webkit-scrollbar {
            height: 8px;
        }

        .category-scroll-desktop::-webkit-scrollbar-track {
            background: transparent;
        }

        .category-scroll-desktop::-webkit-scrollbar-thumb {
            background-color: #BF3131;
            border-radius: 4px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        .category-scroll-desktop::-webkit-scrollbar-thumb:hover {
            background-color: #a12828;
        }

        /* Scrollbar Hide for Mobile */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Mobile Category Button Styles - UPDATED to match desktop theme */
        .category-btn-mobile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            /* Reduced from desktop 12px */
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 65px;
            padding: 6px 2px;
        }

        .category-btn-mobile:hover {
            transform: translateY(-2px);
        }

        .category-icon-mobile {
            width: 48px;
            /* Scaled down from desktop 64px */
            height: 48px;
            /* Scaled down from desktop 64px */
            border-radius: 12px;
            /* Scaled down from desktop 16px */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 2px solid transparent;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-icon-mobile:hover {
            background-color: #fff5f5;
            border-color: #fed7d7;
            transform: translateY(-2px);
        }

        .category-icon-mobile.active {
            background-color: #BF3131;
            border-color: #BF3131;
            color: white;
            width: 56px;
            /* Scaled down from desktop 72px */
            height: 56px;
            /* Scaled down from desktop 72px */
            transform: scale(1.1);
        }


        .category-icon-mobile span {
            font-size: 18px;
            /* Scaled down from desktop 24px */
        }

        .category-label-mobile {
            font-size: 12px;
            /* Scaled down from desktop 14px */
            font-weight: 500;
            color: #6b7280;
            transition: color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-btn-mobile:hover .category-label-mobile {
            color: #BF3131;
        }

        .category-btn-mobile .category-icon-mobile.active+.category-label-mobile {
            color: #BF3131;
            font-weight: 600;
            font-size: 13px;
            /* Scaled down from desktop 15px */
        }

        /* Mobile Category Scroll Container - UPDATED to match desktop */
        .category-scroll-mobile {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            /* Reduced from desktop 30px */
            padding: 16px 20px;
            /* Reduced from desktop 20px 40px */
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .category-scroll-mobile::-webkit-scrollbar {
            height: 6px;
            /* Smaller than desktop 8px */
        }

        .category-scroll-mobile::-webkit-scrollbar-track {
            background: transparent;
        }

        .category-scroll-mobile::-webkit-scrollbar-thumb {
            background-color: #BF3131;
            border-radius: 3px;
            border: 1px solid transparent;
            background-clip: content-box;
        }

        .category-scroll-mobile::-webkit-scrollbar-thumb:hover {
            background-color: #a12828;
        }

        /* Responsive Adjustments - UPDATED */
        @media (max-width: 640px) {
            .category-btn-mobile {
                min-width: 65px;
                padding: 6px 2px;
                gap: 8px;
            }

            .category-icon-mobile {
                width: 48px;
                height: 48px;
                border-radius: 12px;
            }

            .category-icon-mobile.active {
                width: 56px;
                height: 56px;
            }

            .category-icon-mobile span {
                font-size: 18px;
            }

            .category-label-mobile {
                font-size: 12px;
            }

            .category-btn-mobile .category-icon-mobile.active+.category-label-mobile {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .category-btn-mobile {
                min-width: 60px;
                gap: 6px;
            }

            .category-icon-mobile {
                width: 40px;
                height: 40px;
                border-radius: 10px;
            }

            .category-icon-mobile.active {
                width: 48px;
                height: 48px;
            }

            .category-icon-mobile span {
                font-size: 16px;
            }

            .category-label-mobile {
                font-size: 10px;
            }

            .category-btn-mobile .category-icon-mobile.active+.category-label-mobile {
                font-size: 11px;
            }

            .category-scroll-mobile {
                gap: 16px;
                padding: 12px 16px;
            }

        }
    </style>
    <div class="py-16 bg-[#FEF3E2] content_section pt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 inline-block relative" data-aos="fade-up" data-aos-delay="100">
                    <span class="bg-clip-text text-transparent bg-[#BF3131]">Pilih Frame Terbaikmu</span>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1/2 h-1 bg-[#BF3131] rounded-full"
                        data-aos="fade-right" data-aos-delay="300"></div>
                </h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">Temukan koleksi
                    frame eksklusif untuk menciptakan kenangan yang tak terlupakan</p>
            </div>

            <!-- Category Selector Section -->
            <div class="mb-8 bg-transparent rounded-xl p-4 sm:p-6">
                <!-- Mobile: Horizontal Scrollable Categories - UPDATED -->
                <div class="block sm:hidden mb-4">
                    <div class="category-scroll-mobile" style="scroll-snap-type: x mandatory;">
                        <a href="{{ route('frametemp') }}" class="category-btn-mobile group flex-shrink-0"
                            style="scroll-snap-align: start;">
                            <div class="category-icon-mobile {{ !isset($selectedCategory) ? 'active' : '' }}">
                                <span>🏠</span>
                            </div>
                            <span class="category-label-mobile">Semua</span>
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('frametemp', ['category' => $category->id]) }}"
                                class="category-btn-mobile group flex-shrink-0" style="scroll-snap-align: start;">
                                <div
                                    class="category-icon-mobile {{ isset($selectedCategory) && $selectedCategory->id == $category->id ? 'active' : '' }}">
                                    <span>{{ $category->icon }}</span>
                                </div>
                                <span class="category-label-mobile">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Desktop: Grid Layout -->
                <!-- Desktop Category Grid -->
                <div class="hidden sm:flex justify-center items-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-4/5 category-scroll-desktop">
                        <a href="{{ route('frametemp') }}" class="category-btn group flex-shrink-0"
                            style="scroll-snap-align: start;" data-aos="zoom-in" data-aos-delay="400">
                            <div class="category-icon {{ !isset($selectedCategory) ? 'active' : '' }}">
                                <span class="text-lg">🏠</span>
                            </div>
                            <span class="category-label">Semua</span>
                        </a>
                        @foreach ($categories as $index => $category)
                            <a href="{{ route('frametemp', ['category' => $category->id]) }}"
                                class="category-btn group flex-shrink-0" style="scroll-snap-align: start;"
                                data-aos="zoom-in" data-aos-delay="{{ 400 + $index * 100 }}">
                                <div
                                    class="category-icon {{ isset($selectedCategory) && $selectedCategory->id == $category->id ? 'active' : '' }}">
                                    <span class="text-lg">{{ $category->icon }}</span>
                                </div>
                                <span class="category-label">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Mobile Filter Layout -->
            <div class="block sm:hidden">
                <button id="toggleFilter"
                    class="w-full relative flex items-center justify-between px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 rounded-lg border border-gray-300 transition-all duration-300 text-sm font-medium text-gray-700 mb-3">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter & Urutkan</span>
                    </div>

                    <svg id="filterArrow" xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    <div
                        class="w-3 h-3 bg-green-500 absolute -top-1 -right-1 z-50 rounded-full {{ !request('sort_rating') && !request('sort_popular') ? 'hidden' : '' }} ">
                    </div>
                </button>

                <div id="filterOptions" class="hidden space-y-2 animate-fade-in mb-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 block">Urutkan</label>
                        <div class="flex gap-2">
                            <a href="{{ route('frametemp', array_merge(request()->except(['sort_rating', 'sort_popular']), ['sort_rating' => request('sort_rating') == 'desc' ? 'asc' : 'desc'])) }}"
                                class="mobile-rating-filter-btn flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 border {{ request('sort_rating') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ request('sort_rating') == 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                                <span>Rating
                                    {{ request('sort_rating') == 'desc' ? 'Tinggi ke Rendah' : (request('sort_rating') == 'asc' ? 'Rendah ke Tinggi' : '') }}</span>
                            </a>
                            <a href="{{ route('frametemp', array_merge(request()->except(['sort_rating', 'sort_popular']), ['sort_popular' => request('sort_popular') == 'desc' ? 'asc' : 'desc'])) }}"
                                class="mobile-popular-filter-btn flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 border {{ request('sort_popular') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ request('sort_popular') == 'desc' ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                                </svg>
                                <span>Popularitas
                                    {{ request('sort_popular') == 'desc' ? 'Tinggi ke Rendah' : (request('sort_popular') == 'asc' ? 'Rendah ke Tinggi' : '') }}</span>
                            </a>
                            <a href="{{ route('frametemp', request()->except(['sort_rating', 'sort_popular'])) }}"
                                class="mobile-default-filter-btn flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 border {{ !request('sort_rating') && !request('sort_popular') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <span>Default</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center gap-2 bg-gradient-to-r from-[#FEF3E2] to-red-50 px-4 py-3 rounded-lg border border-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#BF3131]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">
                        <span class="font-bold text-[#BF3131]">{{ $frames->count() }}</span> Frame Tersedia
                    </span>
                </div>
            </div>

            <!-- Desktop Filter Layout -->
            <div class="hidden sm:flex sm:flex-row gap-4 justify-between items-center" data-aos="fade-up"
                data-aos-delay="200">
                <div class="flex items-center gap-4">
                    <button id="toggleFilter"
                        class="flex relative items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 rounded-lg border border-gray-300 transition-all duration-300 text-sm font-medium text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter & Urutkan</span>
                        <svg id="filterArrow" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <div
                            class="w-3 h-3 bg-green-500 absolute -top-1 -right-1 z-50 rounded-full {{ !request('sort_rating') && !request('sort_popular') ? 'hidden' : '' }} ">
                        </div>
                    </button>

                    <div id="filterOptions" class="hidden gap-3 animate-fade-in flex">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('frametemp', array_merge(request()->except(['sort_rating', 'sort_popular']), ['sort_rating' => request('sort_rating') == 'desc' ? 'asc' : 'desc'])) }}"
                                class="rating-filter-btn flex items-center gap-1 px-2 py-1 rounded-md text-xs font-medium transition-all duration-300 border {{ request('sort_rating') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ request('sort_rating') == 'desc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                                <span>Rating
                                    {{ request('sort_rating') == 'desc' ? 'Tinggi ke Rendah' : (request('sort_rating') == 'asc' ? 'Rendah ke Tinggi' : '') }}</span>
                            </a>
                        </div>
                        <div class="w-px h-6 bg-gray-300"></div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('frametemp', array_merge(request()->except(['sort_rating', 'sort_popular']), ['sort_popular' => request('sort_popular') == 'desc' ? 'asc' : 'desc'])) }}"
                                class="popular-filter-btn flex items-center gap-1 px-2 py-1 rounded-md text-xs font-medium transition-all duration-300 border {{ request('sort_popular') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ request('sort_popular') == 'desc' ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                                </svg>
                                <span>Popularitas
                                    {{ request('sort_popular') == 'desc' ? 'Tinggi ke Rendah' : (request('sort_popular') == 'asc' ? 'Rendah ke Tinggi' : '') }}</span>
                            </a>
                        </div>
                        <div class="w-px h-6 bg-gray-300"></div>
                        <a href="{{ route('frametemp', request()->except(['sort_rating', 'sort_popular'])) }}"
                            class="default-filter-btn flex items-center gap-1 px-2 py-1 rounded-md text-xs font-medium transition-all duration-300 border {{ !request('sort_rating') && !request('sort_popular') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span>Default</span>
                        </a>
                    </div>
                </div>

                <div
                    class="flex items-center gap-2 bg-gradient-to-r from-[#FEF3E2] to-red-50 px-4 py-2 rounded-lg border border-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#BF3131]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">
                        <span class="font-bold text-[#BF3131]">{{ $frames->count() }}</span> Frame
                    </span>
                </div>
            </div>

            <div class="mt-12">
                @if ($frames->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach ($frames as $index => $frame)
                            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 frame-card relative"
                                data-frame-id="{{ $frame->id }}" data-aos="frame-fade-up"
                                data-aos-delay="{{ ($loop->index % 4) * 100 }}"
                                style="--aos-order: {{ $loop->index % 4 }}">
                                <div class="absolute top-3 right-3 z-10">
                                    @if ($frame->isFree())
                                        <span
                                            class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            GRATIS
                                        </span>
                                    @else
                                        <span
                                            class="bg-gradient-to-r from-amber-500 to-yellow-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            {{ number_format($frame->price, 0, ',', '.') }} IDR
                                        </span>
                                    @endif
                                </div>
                                <div class="relative h-60 bg-gradient-to-br from-gray-100 to-red-50 overflow-hidden">
                                    <div
                                        class="absolute inset-0 flex items-center justify-center p-4 transition-transform duration-500 group-hover:scale-105">
                                        @if ($frame->image_path)
                                            <img src="{{ asset('storage/' . $frame->image_path) }}"
                                                alt="{{ $frame->name }}" class="max-h-full max-w-full object-contain">
                                        @else
                                            <div class="text-gray-400 text-5xl">🖼️</div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-sm">
                                        <button
                                            class="px-5 py-2.5 bg-white/95 cursor-pointer text-gray-800 rounded-full font-medium hover:bg-red-50 transition-colors duration-300 transform hover:scale-105 preview-button shadow-md flex items-center gap-2"
                                            data-frame-id="{{ $frame->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Preview
                                        </button>
                                    </div>
                                </div>

                                <div class="p-5 bg-white">
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-start">
                                            <h3
                                                class="text-lg font-semibold text-gray-900 group-hover:text-[#BF3131] transition-colors">
                                                {{ $frame->name }}</h3>
                                            <div class="flex items-center gap-1.5 px-2 py-1 bg-red-50 rounded-full">
                                                <span class="text-base">{{ $frame->category->icon }}</span>
                                                <span class="text-xs text-gray-700">{{ $frame->category->name }}</span>
                                            </div>
                                        </div>
                                        @if ($frame->testimonis_avg_rating)
                                            <div class="flex items-center justify-between">
                                                <div
                                                    class="flex items-center gap-2 bg-gradient-to-r from-yellow-50 to-orange-50 px-3 py-1.5 rounded-lg border border-yellow-200">
                                                    <div class="flex items-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= round($frame->testimonis_avg_rating))
                                                                <svg class="w-4 h-4 text-yellow-400 fill-current drop-shadow-sm"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                                </svg>
                                                            @else
                                                                <svg class="w-4 h-4 text-gray-300 fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                                </svg>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span
                                                        class="text-sm font-semibold text-gray-800">{{ number_format($frame->testimonis_avg_rating, 1) }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="flex items-center gap-2 bg-gradient-to-r from-gray-50 to-gray-100 px-3 py-1.5 rounded-lg border border-gray-200">
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 text-gray-300 fill-current"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-500 font-medium">Belum ada rating</span>
                                            </div>
                                        @endif
                                        <div class="border-t border-gray-100"></div>
                                        @if ($frame->isFree())
                                            <a href="{{ route('booth', ['frame_id' => $frame->id]) }}"
                                                class="mt-2 inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 w-full transition-all duration-300 shadow-sm hover:shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                                </svg>
                                                Gunakan Frame
                                            </a>
                                        @else
                                            <button
                                                onclick="showPremiumModal({{ $frame->id }}, '{{ number_format($frame->price, 0, ',', '.') }}', '{{ addslashes($frame->name) }}', '{{ asset('storage/' . $frame->image_path) }}')"
                                                class="mt-2 cursor-pointer inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 w-full transition-all duration-300 shadow-sm hover:shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                Gunakan Premium
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-r from-red-500/20 to-amber-500/20 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 bg-[#FEF3E2]">
                        <div class="inline-block text-7xl mb-6">😥</div>
                        <p class="text-xl text-gray-600 font-light">
                            Tidak ada frame yang tersedia untuk kategori
                            {{ isset($selectedCategory) ? '"' . $selectedCategory->name . '"' : 'ini' }}.
                        </p>
                        <p class="mt-3 text-gray-500">Silakan pilih kategori lain atau kembali lagi nanti.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@section('content_section')
    @include('components.customFrame')
@endsection

<div id="previewCameraModal" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm modal-backdrop"></div>

    <!-- Desktop Modal -->
    <div
        class="relative bg-white rounded-xl shadow-xl p-6 w-full max-w-4xl mx-4 hidden md:block animate-[modalFadeIn_0.3s]">
        <button
            class="modal-close absolute top-4 right-4 text-2xl text-gray-500 hover:text-black cursor-pointer">×</button>

        <h2 class="text-xl font-semibold mb-4 text-center">Frame Preview</h2>

        <div class="flex flex-row gap-6 justify-center items-center">
            <div class="w-3/5">

                <div class="relative bg-white rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                    <video id="previewVideo" autoplay muted class="w-full h-full object-cover scale-x-[-1]"></video>
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

            <div class=" relative" style="width: 190px; height: 500px;">
                <div id="previewFrameContainer"
                    class="w-full h-full relative bg-transparent shadow-md overflow-hidden">
                    <div id="previewFrameImage" class="absolute inset-0 flex items-center justify-center bg-gray-100">
                        <p class="text-gray-400 text-center p-4">Frame akan muncul di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Modal -->
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
                <!-- Tambahkan button toggle camera di dalam mobile modal, setelah video element -->
                <div class="relative bg-white rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                    <video id="mobilePreviewVideo" autoplay muted
                        class="w-full h-full object-cover scale-x-[-1]"></video>

                    <!-- Toggle Camera Button - Khusus Mobile -->
                    <button id="toggleCameraButton"
                        class="absolute top-4 right-4 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-all duration-300 backdrop-blur-sm">
                        <svg id="cameraIcon" class="w-6 h-6" fill="none" stroke="currentColor"
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
                <div class=" relative" style="width: 190px; height: 500px;">
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

<div id="paymentModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
    <div class="modal-backdrop absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    <div class="modal-content bg-white rounded-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto relative">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-[#FEF3E2] to-[#FEF3E2]/70 rounded-t-2xl p-6 border-b-2 border-[#BF3131]/20">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">Pembayaran Premium</h3>
                    <p class="text-sm text-gray-600">Upgrade untuk akses frame eksklusif</p>
                </div>
                <!-- Close Button (Visible on all devices) -->
                <button onclick="closePaymentModal()"
                    class="modal-close text-gray-500 hover:text-[#BF3131] transition duration-300 hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <form id="paymentForm" enctype="multipart/form-data">
                <input type="hidden" id="frameId" name="frame_id">

                <!-- Frame Info Card -->
                <div
                    class="mb-6 p-4 bg-gradient-to-r from-[#FEF3E2] to-[#FEF3E2]/50 rounded-xl border-2 border-[#BF3131]/20 relative overflow-hidden">
                    <div class="absolute -right-2 -top-2 w-8 h-8 text-[#BF3131] opacity-10">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium" id="frameName">Frame Premium</p>
                            <p class="font-bold text-2xl text-[#BF3131]" id="framePrice">Rp 25.000</p>
                        </div>
                        <div
                            class="w-16 h-16 rounded-lg overflow-hidden border-2 border-[#BF3131]/20 bg-white flex items-center justify-center">
                            <img id="framePreview" src="https://via.placeholder.com/60x60/BF3131/FFFFFF?text=Frame"
                                alt="Frame Preview" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="mb-6">
                    <h4 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Data Pelanggan
                    </h4>

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Nama <span class="text-[#BF3131]">*</span>
                        </label>
                        <input type="text" name="customer_name" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#BF3131]/50 focus:border-[#BF3131] transition duration-300"
                            placeholder="Masukkan nama Anda">
                    </div>

                    <!-- WhatsApp Field -->
                    <div class="mb-4">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                </path>
                            </svg>
                            Nomor WhatsApp <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <input type="tel" name="whatsapp_number"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#BF3131]/50 focus:border-[#BF3131] transition duration-300"
                            placeholder="Contoh: 081234567890">
                        <p class="text-xs text-gray-500 mt-1 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Nomor WhatsApp untuk konfirmasi pembayaran (tidak wajib diisi)
                        </p>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="mb-6">
                    <h4 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                            </path>
                        </svg>
                        Metode Pembayaran
                    </h4>
                    <!-- Payment Method Dropdown -->
                    <div class="mb-4">
                        <select id="paymentMethod" name="payment_method" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#BF3131]/50 focus:border-[#BF3131] transition duration-300 bg-white">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="bank_transfer">E-Wallet</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <!-- Payment Details Container -->
                    <div id="paymentDetailsContainer" class="hidden">
                        <!-- Bank Transfer Details -->
                        <div id="bankTransferDetails"
                            class="mb-4 p-4 border-2 border-[#BF3131]/20 rounded-xl bg-gradient-to-r from-[#FEF3E2]/30 to-transparent">
                            <div class="text-sm text-gray-600 space-y-2">
                                <h5
                                    class="font-bold text-gray-800 text-center flex justify-center items-center text-xl">
                                    E-Wallet</h5>
                                <div
                                    class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100">
                                    <span class="font-medium">Dana:</span>
                                    <div class="text-right">
                                        <span class="font-mono font-bold text-[#BF3131]">0895413770137</span>
                                        <button type="button" onclick="copyToClipboard('0895413770137')"
                                            class="ml-2 text-xs text-[#BF3131] hover:text-[#F16767]">
                                            Copy
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100">
                                    <span class="font-medium">A.n:</span>
                                    <span class="font-semibold">PANORICAM</span>
                                </div>
                                <div class="mt-3 p-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-xs text-yellow-800">
                                        <strong>Instruksi:</strong> Transfer sesuai jumlah yang tertera, lalu upload
                                        bukti transfer di bawah.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- QRIS Details -->
                        <div id="qrisDetails"
                            class="mb-4 p-4 border-2 border-[#BF3131]/20 rounded-xl bg-gradient-to-r from-[#FEF3E2]/30 to-transparent">
                            <div class="flex flex-col items-center">
                                <h5
                                    class="font-bold text-gray-800 text-center flex mb-2 justify-center items-center text-xl">
                                    QRIS
                                </h5>
                                <div id="qrisContainer"
                                    class="w-48 h-48 bg-white rounded-xl border-2 border-dashed border-[#BF3131]/30 flex items-center justify-center mb-3 cursor-pointer">
                                    <img src="{{ asset('qris.jpg') }}" alt="QRIS"
                                        class="w-full h-full object-contain">
                                </div>
                                <p class="text-sm text-gray-600 text-center mb-2">Klik QR untuk memperbesar</p>
                                <div class="w-full p-2 bg-blue-50 border border-blue-200 rounded-lg">
                                    <p class="text-xs text-blue-800 text-center">
                                        <strong>Instruksi:</strong> Scan QR Code dengan aplikasi pembayaran digital,
                                        lalu upload bukti pembayaran.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof -->
                <div class="mb-6">
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 mr-2 text-[#BF3131]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Bukti Pembayaran <span class="text-[#BF3131]">*</span>
                    </label>
                    <div class="relative">
                        <input type="file" name="payment_proof" accept="image/*" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#BF3131]/50 focus:border-[#BF3131] transition duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-[#BF3131] file:text-white hover:file:bg-[#F16767]">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Upload screenshot/foto bukti transfer
                    </p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-[#BF3131] to-[#F16767] text-white py-4 px-6 rounded-xl font-semibold hover:from-[#F16767] hover:to-[#BF3131] transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02] flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Submit Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
<!-- Accept Modal -->
<div id="acceptModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
    <div class="modal-backdrop absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    <div class="modal-content bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <div class="text-center">
            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pembayaran Disetujui</h3>
            <p class="text-gray-600 mb-4">Pembayaran Anda (Order ID: <span id="acceptOrderId"></span>) telah
                disetujui. Anda akan diarahkan ke booth.</p>
            <button onclick="redirectToBooth()"
                class="w-full py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                Lanjutkan ke Booth
            </button>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
    <div class="modal-backdrop absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    <div class="modal-content bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <div class="text-center">
            <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pembayaran Ditolak</h3>
            <p class="text-gray-600 mb-4">Pembayaran Anda (Order ID: <span id="rejectOrderId"></span>) ditolak oleh
                admin. Silakan coba lagi.</p>
            <button onclick="closeRejectModal()"
                class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
<div id="qrisModal">
    <div id="qrisModalContent">
        <img id="qrisModalImg" src="{{ asset('qris.jpg') }}" alt="QRIS">
    </div>
</div>
<script>
    // Update your AOS initialization
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: false,
        mirror: true,
        offset: 120,
        disable: function() {
            return window.innerWidth < 768; // Disable on mobile
        }
    });

    // Refresh AOS when window is resized
    window.addEventListener('resize', function() {
        AOS.refresh();
    });
    // Configure toastr options
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

    let currentFrameId = null;
    let currentFramePrice = null;
    let isFilterOpen = false;
    let currentFacingMode = 'user';
    let isTogglingCamera = false;

    document.getElementById('paymentMethod').addEventListener('change', function() {
        const selectedMethod = this.value;
        const detailsContainer = document.getElementById('paymentDetailsContainer');
        const bankDetails = document.getElementById('bankTransferDetails');
        const qrisDetails = document.getElementById('qrisDetails');

        if (selectedMethod) {
            detailsContainer.classList.remove('hidden');

            // Hide all details first
            bankDetails.style.display = 'none';
            qrisDetails.style.display = 'none';

            // Show selected method details
            if (selectedMethod === 'bank_transfer') {
                bankDetails.style.display = 'block';
            } else if (selectedMethod === 'qris') {
                qrisDetails.style.display = 'block';
            }
        } else {
            detailsContainer.classList.add('hidden');
        }
    });

    // Show Payment Modal
    function showPremiumModal(frameId, price, frameName, frameImageUrl) {
        const paymentData = {
            frame_id: frameId,
            price: price,
            frame_name: frameName,
            frame_image: frameImageUrl,
            timestamp: Date.now()
        };
        localStorage.setItem('pendingPremiumFrame', JSON.stringify(paymentData));

        const storedData = localStorage.getItem('pendingPremiumFrame');
        if (!storedData) {
            console.error('Gagal menyimpan data frame.');
            toastr.error('Gagal menyimpan data frame. Silakan coba lagi.');
            return;
        }

        try {
            const parsedData = JSON.parse(storedData);
            if (parsedData.frame_id !== frameId || parsedData.price !== price) {
                console.error('Data frame tidak valid.');
                localStorage.removeItem('pendingPremiumFrame');
                toastr.error('Data frame tidak valid.');
                return;
            }

            // Update modal content
            document.getElementById('frameId').value = frameId;
            document.getElementById('framePrice').textContent = 'Rp ' + price;
            document.getElementById('frameName').textContent = 'Frame ' + frameName || 'Frame Premium';

            const framePreview = document.getElementById('framePreview');
            if (frameImageUrl && frameImageUrl !== '') {
                framePreview.src = frameImageUrl;
                framePreview.alt = frameName || 'Frame Preview';
            } else {
                framePreview.src = 'https://via.placeholder.com/60x60/BF3131/FFFFFF?text=Frame';
                framePreview.alt = 'Frame Preview';
            }

            // Show modal
            const modal = document.getElementById('paymentModal');
            const modalBackdrop = modal.querySelector('.modal-backdrop');
            const modalContent = modal.querySelector('.modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('show');
            document.body.classList.add('modal-open');

            setTimeout(() => {
                modalBackdrop.classList.add('show');
                modalContent.classList.remove('hide');
            }, 50);

            // Enable drag-to-close for mobile
            enableDragToClose(modalContent);
        } catch (error) {
            console.error('Error parsing pendingPremiumFrame:', error);
            localStorage.removeItem('pendingPremiumFrame');
            toastr.error('Terjadi kesalahan saat memproses data frame.');
        }
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const modalContent = modal.querySelector('.modal-content');

        modalBackdrop.classList.remove('show');
        modalContent.classList.add('hide');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('show');
            document.getElementById('paymentForm').reset();
            document.body.classList.remove('modal-open');
            localStorage.removeItem('pendingPremiumFrame');

            // Panggil fungsi reset dropdown
            resetPaymentDropdown();
        }, 300);
    }

    // Enable Drag-to-Close for Mobile Modal
    function enableDragToClose(element) {
        if (!element || window.innerWidth > 640) return; // Only enable on mobile

        let startY = 0;
        let currentY = 0;
        let isDragging = false;
        let startTime = 0;

        element.addEventListener('touchstart', function(e) {
            const target = e.target;
            const isHeaderArea = target.closest('.modal-drag-handle') || target.closest('.bg-gradient-to-r');

            if (isHeaderArea) {
                startY = e.touches[0].clientY;
                startTime = Date.now();
                isDragging = true;
                element.style.transition = ''; // Remove transition during drag
            }
        }, {
            passive: true
        });

        element.addEventListener('touchmove', function(e) {
            if (!isDragging) return;

            currentY = e.touches[0].clientY;
            const dragDistance = currentY - startY;

            if (dragDistance > 0) {
                element.style.transform = `translateY(${dragDistance}px)`;
                const opacity = Math.max(0.5, 1 - (dragDistance / 300));
                element.style.opacity = opacity;
                document.querySelector('#paymentModal .modal-backdrop').style.opacity = opacity;
            }
        }, {
            passive: true
        });

        element.addEventListener('touchend', function() {
            if (!isDragging) return;

            const dragDistance = currentY - startY;
            const dragTime = Date.now() - startTime;
            const dragVelocity = dragDistance / dragTime;

            if (dragDistance > 150 || (dragDistance > 50 && dragVelocity > 0.5)) {
                closePaymentModal();
            } else {
                element.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
                element.style.transform = '';
                element.style.opacity = '';
                document.querySelector('#paymentModal .modal-backdrop').style.opacity = '';

                setTimeout(() => {
                    element.style.transition = '';
                }, 300);
            }

            isDragging = false;
        }, {
            passive: true
        });
    }

    // Handle backdrop click to close modal
    document.getElementById('paymentModal').addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            closePaymentModal();
        }
    });


    function showPleaseWaitModal(orderId) {
        const modal = document.createElement('div');
        modal.id = 'pleaseWaitModal';
        modal.className = 'fixed inset-0 flex items-center justify-center z-50';
        modal.innerHTML = `
        <div class="modal-content bg-white rounded-2xl p-6 w-full max-w-md mx-4">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500 mx-auto mb-4"></div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Menunggu Konfirmasi</h3>
                <p class="text-gray-600">Pembayaran Anda (Order ID: ${orderId}) sedang diproses. Silakan tunggu konfirmasi dari admin.</p>
            </div>
        </div>
    `;
        document.body.appendChild(modal);

        // Show the modal
        modal.classList.add('show');
        document.body.classList.add('modal-open'); // Prevent body scroll
    }

    function closePleaseWaitModal() {
        const modal = document.getElementById('pleaseWaitModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.remove();
                document.body.classList.remove('modal-open'); // Re-enable body scroll
            }, 300); // Match transition duration
        }
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show feedback
            const event = new CustomEvent('showToast', {
                detail: {
                    message: 'Nomor rekening berhasil disalin!',
                    type: 'success'
                }
            });
            window.dispatchEvent(event);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.getElementById('paymentForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        const frameId = formData.get('frame_id');

        submitButton.disabled = true;
        submitButton.textContent = 'Memproses...';

        try {
            const response = await fetch('{{ route('payment.create') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            });

            const result = await response.json();

            if (result.success) {
                const pendingPayment = {
                    order_id: result.order_id,
                    frame_id: frameId,
                    timestamp: Date.now(),
                    status: 'pending'
                };

                localStorage.setItem('pendingPayment', JSON.stringify(pendingPayment));

                closePaymentModal();
                showPleaseWaitModal(result.order_id);
                startPaymentStatusCheck(result.order_id, frameId);
            } else {
                toastr.error('Error: ' + result.message);
                submitButton.disabled = false;
                submitButton.textContent = 'Submit Pembayaran';
            }
        } catch (error) {
            toastr.error('Terjadi kesalahan: ' + error.message);
            submitButton.disabled = false;
            submitButton.textContent = 'Submit Pembayaran';
        }
    });

    function startPaymentStatusCheck(orderId, frameId) {
        const interval = setInterval(async () => {
            try {
                const response = await fetch(`/check-payment-status/${orderId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (result.status === 'approved') {
                    clearInterval(interval);
                    closePleaseWaitModal();

                    const pendingPayment = JSON.parse(localStorage.getItem('pendingPayment') || '{}');
                    pendingPayment.status = 'approved';
                    localStorage.setItem('pendingPayment', JSON.stringify(pendingPayment));

                    // Bersihkan data pendingPremiumFrame setelah pembayaran disetujui
                    localStorage.removeItem('pendingPremiumFrame');

                    // Show Accept Modal
                    showAcceptModal(orderId, frameId);
                } else if (result.status === 'rejected') {
                    clearInterval(interval);
                    closePleaseWaitModal();
                    localStorage.removeItem('pendingPayment');
                    localStorage.removeItem('pendingPremiumFrame');

                    // Show Reject Modal
                    showRejectModal(orderId);
                }
            } catch (error) {
                console.error('Error checking payment status:', error);
            }
        }, 5000);
    }

    // Show Accept Modal
    function showAcceptModal(orderId, frameId) {
        const modal = document.getElementById('acceptModal');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const modalContent = modal.querySelector('.modal-content');
        const orderIdElement = document.getElementById('acceptOrderId');

        orderIdElement.textContent = orderId;
        modal.classList.remove('hidden');
        modal.classList.add('show');
        document.body.classList.add('modal-open');

        setTimeout(() => {
            modalBackdrop.classList.add('show');
            modalContent.classList.remove('hide');
        }, 50);

        // Store frameId for redirect
        modal.dataset.frameId = frameId;
    }

    // Show Reject Modal
    function showRejectModal(orderId) {
        const modal = document.getElementById('rejectModal');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const modalContent = modal.querySelector('.modal-content');
        const orderIdElement = document.getElementById('rejectOrderId');

        orderIdElement.textContent = orderId;
        modal.classList.remove('hidden');
        modal.classList.add('show');
        document.body.classList.add('modal-open');

        setTimeout(() => {
            modalBackdrop.classList.add('show');
            modalContent.classList.remove('hide');
        }, 50);
    }

    // Redirect to Booth
    function redirectToBooth() {
        const modal = document.getElementById('acceptModal');
        const frameId = modal.dataset.frameId;
        const orderId = document.getElementById('acceptOrderId').textContent;
        const boothUrl = `/booth?frame_id=${encodeURIComponent(frameId)}&order_id=${encodeURIComponent(orderId)}`;

        modal.classList.add('hidden');
        modal.classList.remove('show');
        document.body.classList.remove('modal-open');

        window.location.href = boothUrl;
    }

    // Close Reject Modal
    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const modalContent = modal.querySelector('.modal-content');

        modalBackdrop.classList.remove('show');
        modalContent.classList.add('hide');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
        }, 300);
    }

    function validateAndRedirectIfApproved() {
        try {
            const pendingPaymentLS = localStorage.getItem('pendingPayment');
            const pendingPayment = JSON.parse(pendingPaymentLS || '{}');

            if (pendingPayment &&
                pendingPayment.status === 'approved' &&
                pendingPayment.frame_id &&
                pendingPayment.order_id) {
                console.log('Found approved payment, redirecting to booth...', pendingPayment);
                const boothUrl =
                    `/booth?frame_id=${encodeURIComponent(pendingPayment.frame_id)}&order_id=${encodeURIComponent(pendingPayment.order_id)}`;
                window.location.href = boothUrl;
                return true;
            }

            return false;
        } catch (error) {
            console.error('Error validating payment data:', error);
            localStorage.removeItem('pendingPayment');
            return false;
        }
    }

    async function checkCurrentPaymentStatus() {
        try {
            const pendingPaymentLS = localStorage.getItem('pendingPayment');
            const pendingPayment = JSON.parse(pendingPaymentLS || '{}');

            if (pendingPayment && pendingPayment.order_id && pendingPayment.status === 'pending') {
                const response = await fetch(`/check-payment-status/${pendingPayment.order_id}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.status === 'approved') {
                    pendingPayment.status = 'approved';
                    localStorage.setItem('pendingPayment', JSON.stringify(pendingPayment));
                    localStorage.removeItem('pendingPremiumFrame');
                    const boothUrl =
                        `/booth?frame_id=${encodeURIComponent(pendingPayment.frame_id)}&order_id=${encodeURIComponent(pendingPayment.order_id)}`;
                    window.location.href = boothUrl;
                } else if (result.status === 'rejected') {
                    localStorage.removeItem('pendingPayment');
                    localStorage.removeItem('pendingPremiumFrame');
                    toastr.error('Pembayaran ditolak oleh admin.', 'Gagal');
                }
            }
        } catch (error) {
            console.error('Error checking payment status:', error);
        }
    }

    // Fungsi untuk memeriksa dan membuka modal pembayaran otomatis berdasarkan localStorage
    function checkAndOpenPaymentModal() {
        try {
            const pendingPremiumFrame = localStorage.getItem('pendingPremiumFrame');
            if (!pendingPremiumFrame) {
                return Promise.resolve(false); // Return a resolved Promise with false
            }

            const data = JSON.parse(pendingPremiumFrame);
            const currentTime = Date.now();

            if (!data.frame_id || !data.price || !data.timestamp) {
                console.warn('Invalid pendingPremiumFrame data:', data);
                localStorage.removeItem('pendingPremiumFrame');
                return Promise.resolve(false); // Return a resolved Promise with false
            }

            if (currentTime - data.timestamp > 60 * 60 * 1000) {
                console.log('Pending premium frame data expired');
                localStorage.removeItem('pendingPremiumFrame');
                return Promise.resolve(false); // Return a resolved Promise with false
            }

            return fetch(`/get-frame-status/${data.frame_id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Frame not found: ${data.frame_id}`);
                    }
                    return response.json();
                })
                .then(frameData => {
                    if (frameData.price > 0 && frameData.price.toString() === data.price) {
                        console.log('Valid pendingPremiumFrame found, opening payment modal:', data);
                        showPremiumModal(data.frame_id, data.price, data.frame_name, data.frame_image);
                        return true; // Return true to indicate modal was opened
                    } else {
                        console.warn('Frame price mismatch or free frame:', frameData);
                        localStorage.removeItem('pendingPremiumFrame');
                        return false; // Return false if validation fails
                    }
                })
                .catch(error => {
                    console.error('Error validating frame status:', error);
                    localStorage.removeItem('pendingPremiumFrame');
                    return false; // Return false on error
                });
        } catch (error) {
            console.error('Error checking pendingPremiumFrame:', error);
            localStorage.removeItem('pendingPremiumFrame');
            return Promise.resolve(false); // Return a resolved Promise with false
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        clearDownloadedData();

        // Validasi dan redirect jika ada pembayaran yang sudah disetujui
        const redirected = validateAndRedirectIfApproved();

        // Jika tidak ada redirect, lanjutkan inisialisasi
        if (!redirected) {
            // Periksa pendingPayment di localStorage
            const pendingPayment = JSON.parse(localStorage.getItem('pendingPayment') || '{}');
            if (pendingPayment.status === 'pending' && pendingPayment.order_id && pendingPayment.frame_id) {
                showPleaseWaitModal(pendingPayment.order_id);
                startPaymentStatusCheck(pendingPayment.order_id, pendingPayment.frame_id);
            } else {
                // Inisialisasi UI lainnya hanya jika tidak ada modal yang dibuka
                checkAndOpenPaymentModal().then(opened => {
                    if (!opened) {
                        initializeToggleFilter();
                        setupFrameCards();
                        attachAllListeners();
                    }
                });
            }

            window.addEventListener('popstate', function() {
                location.reload();
            });

            if (!window.html2canvas) {
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
                script.async = true;
                document.head.appendChild(script);
                console.log('Loading html2canvas script...');
            }
        }

        const paymentModal = document.getElementById('paymentModal');
        if (paymentModal.classList.contains('show')) {
            document.body.classList.add('modal-open');
            enableDragToClose(paymentModal.querySelector('.modal-content'));
        }
    });

    function forceCheckAndRedirect() {
        const redirected = validateAndRedirectIfApproved();
        if (!redirected) {
            checkCurrentPaymentStatus();
        }
    }

    // Fungsi lainnya tetap sama seperti sebelumnya
    function setupFrameCards() {
        const frameCards = document.querySelectorAll('.frame-card');
        console.log(`Found ${frameCards.length} frame cards`);

        frameCards.forEach(card => {
            const overlay = card.querySelector('.group-hover\\:opacity-100');
            const frameId = card.dataset.frameId;

            if (!overlay) {
                console.warn('Overlay not found for frame card:', card);
                return;
            }

            let previewBtn = overlay.querySelector('.preview-button');
            if (!previewBtn) {
                previewBtn = document.createElement('button');
                previewBtn.className =
                    'px-4 py-2 bg-white/90 text-gray-800 rounded-full font-medium hover:bg-red-50 transition-colors duration-300 transform hover:scale-105 preview-button';
                previewBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Preview
            `;
                previewBtn.dataset.frameId = frameId;
                overlay.appendChild(previewBtn);
                console.log('Created preview button for frame ID:', frameId);
            } else {
                if (frameId && !previewBtn.dataset.frameId) {
                    previewBtn.dataset.frameId = frameId;
                    console.log('Updated preview button with frame ID:', frameId);
                }
            }

            previewBtn.removeEventListener('click', openPreviewCameraModal);
            previewBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Preview button clicked for frame ID:', frameId);
                openPreviewCameraModal(e);
            });
        });
    }

    function openPreviewCameraModal(e) {
        e.preventDefault();
        e.stopPropagation();

        console.log('openPreviewCameraModal called');

        const modal = document.getElementById('previewCameraModal');
        if (!modal) {
            console.error('Modal element not found!');
            toastr.error('Modal tidak ditemukan. Silakan coba lagi.');
            return;
        }

        resetModalState();

        const mobileModalContainer = modal.querySelector('.mobile-modal-container');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const video = document.getElementById('previewVideo');
        const mobileVideo = document.getElementById('mobilePreviewVideo');
        const previewFrameContainer = document.getElementById('previewFrameContainer');
        const previewFrameImage = document.getElementById('previewFrameImage');
        const mobilePreviewFrameContainer = document.getElementById('mobilePreviewFrameContainer');
        const mobilePreviewFrameImage = document.getElementById('mobilePreviewFrameImage');
        const captureButton = document.getElementById('previewCaptureButton');
        const mobileCaptureButton = document.getElementById('mobilePreviewCaptureButton');
        const watermark = document.getElementById('previewWatermark');
        const mobileWatermark = document.getElementById('mobilePreviewWatermark');

        document.body.classList.add('modal-open');
        modal.style.display = 'flex';

        setTimeout(() => {
            modalBackdrop.classList.add('show');
            if (mobileModalContainer) {
                mobileModalContainer.classList.add('show');
            }
        }, 50);

        console.log('Modal display set to flex');

        const frameCard = e.target.closest('.frame-card');
        let frameId = null;

        if (frameCard) {
            frameId = frameCard.dataset.frameId || e.target.dataset.frameId;
            console.log('Frame ID from card or button:', frameId);
        }

        if (frameId) {
            modal.setAttribute('data-frame-id', frameId);
            window.currentFrameId = frameId;

            const loadingContent = `
            <div class="flex items-center justify-center w-full h-full">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500"></div>
            </div>
        `;
            previewFrameImage.innerHTML = loadingContent;
            mobilePreviewFrameImage.innerHTML = loadingContent;

            fetchFrameDetails(frameId);

            fetch(`/get-frame-template/${frameId}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.text();
                })
                .then(html => {
                    previewFrameImage.innerHTML = html;
                    mobilePreviewFrameImage.innerHTML = html;

                    previewFrameContainer.className = 'frame-container-desktop';
                    mobilePreviewFrameContainer.className = 'frame-container-mobile';

                    initializePhotoSlots(previewFrameImage);
                    initializePhotoSlots(mobilePreviewFrameImage, true);
                    console.log('Frame template loaded successfully');
                })
                .catch(error => {
                    console.error('Error loading frame template:', error);
                    const errorContent = `
                    <div class="flex flex-col items-center justify-center w-full h-full text-red-500 p-4">
                        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-center text-sm">Gagal memuat template frame.</p>
                    </div>
                `;
                    previewFrameImage.innerHTML = errorContent;
                    mobilePreviewFrameImage.innerHTML = errorContent;
                    createDummySlots(previewFrameImage);
                    createDummySlots(mobilePreviewFrameImage, true);
                });
        }

        // Check camera permissions before accessing
        checkCameraPermissions().then(hasPermission => {
            if (!hasPermission) {
                handleCameraError(video, captureButton);
                handleCameraError(mobileVideo, mobileCaptureButton);
                toastr.error('Izin kamera ditolak. Silakan aktifkan izin kamera di pengaturan perangkat.');
                return;
            }

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                const isMobile = window.innerWidth <= 768;
                const videoConstraints = {
                    video: {
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
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
                        toastr.error(
                            'Gagal mengakses kamera. Pastikan izin kamera diaktifkan dan coba lagi.');
                    });
            } else {
                handleCameraError(video, captureButton);
                handleCameraError(mobileVideo, mobileCaptureButton);
                toastr.error('Browser Anda tidak mendukung akses kamera.');
            }
        });

        const modalCloseButtons = modal.querySelectorAll('.modal-close');
        modalCloseButtons.forEach(btn => {
            btn.removeEventListener('click', closePreviewCameraModal);
            btn.addEventListener('click', closePreviewCameraModal);
        });

        const toggleCameraButton = document.getElementById('toggleCameraButton');
        if (toggleCameraButton) {
            toggleCameraButton.removeEventListener('click', toggleCamera);
            toggleCameraButton.addEventListener('click', toggleCamera);
        }

        window.removeEventListener('click', handleModalBackdropClick);
        window.addEventListener('click', handleModalBackdropClick);

        captureButton.addEventListener('click', () => startPhotoSession(false));
        mobileCaptureButton.addEventListener('click', () => startPhotoSession(true));

        enableDragToClose(mobileModalContainer);
    }

    function handleCameraError(video, captureButton) {
        video.style.display = 'none';
        const errorMessage = document.createElement('div');
        errorMessage.className = 'flex flex-col items-center justify-center w-full h-full text-red-500';
        errorMessage.innerHTML = `
        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <p class="text-center text-sm">Gagal mengakses kamera. Silakan periksa izin kamera atau coba browser lain.</p>
    `;
        video.parentElement.appendChild(errorMessage);
        if (captureButton) {
            captureButton.disabled = true;
            captureButton.textContent = 'Kamera Tidak Tersedia';
        }
    }

    function checkCameraPermissions() {
        if (!navigator.permissions || !navigator.permissions.query) {
            // Permissions API not supported, assume permission is granted for older browsers
            return Promise.resolve(true);
        }

        return navigator.permissions.query({
                name: 'camera'
            })
            .then(permissionStatus => {
                return permissionStatus.state === 'granted';
            })
            .catch(err => {
                console.error('Error checking camera permissions:', err);
                return false;
            });
    }

    function handleModalBackdropClick(e) {
        const modal = document.getElementById('previewCameraModal');
        const mobileVideo = document.getElementById('mobilePreviewVideo');
        const toggleCameraButton = document.getElementById('toggleCameraButton');
        const captureButton = document.getElementById('mobilePreviewCaptureButton');

        const isClickOnVideo = mobileVideo && mobileVideo.contains(e.target);
        const isClickOnToggleButton = toggleCameraButton && toggleCameraButton.contains(e.target);
        const isClickOnCaptureButton = captureButton && captureButton.contains(e.target);
        const isClickOnFramePreview = e.target.closest('#mobilePreviewFrameContainer');
        const isClickOnModalContent = e.target.closest('.mobile-modal-container > div:not(.modal-backdrop)');

        if (e.target === modal || e.target.classList.contains('modal-backdrop')) {
            if (!isClickOnVideo && !isClickOnToggleButton && !isClickOnCaptureButton &&
                !isClickOnFramePreview && !isClickOnModalContent) {
                closePreviewCameraModal();
            }
        }
    }

    function enableDragToClose(element) {
        if (!element) return;

        let startY = 0;
        let currentY = 0;
        let isDragging = false;
        let startTime = 0;

        element.addEventListener('touchstart', function(e) {
            const target = e.target;
            const isHeaderArea = target.closest('.sticky.top-0') || target.classList.contains('w-12');

            if (isHeaderArea) {
                startY = e.touches[0].clientY;
                startTime = Date.now();
                isDragging = true;
            }
        }, {
            passive: true
        });

        element.addEventListener('touchmove', function(e) {
            if (!isDragging) return;

            currentY = e.touches[0].clientY;
            const dragDistance = currentY - startY;

            if (dragDistance > 0) {
                element.style.transform = `translateY(${dragDistance}px)`;
                const opacity = Math.max(0.5, 1 - (dragDistance / 300));
                element.style.opacity = opacity;
            }
        }, {
            passive: true
        });

        element.addEventListener('touchend', function() {
            if (!isDragging) return;

            const dragDistance = currentY - startY;
            const dragTime = Date.now() - startTime;
            const dragVelocity = dragDistance / dragTime;

            if (dragDistance > 150 || (dragDistance > 50 && dragVelocity > 0.5)) {
                closePreviewCameraModal();
            } else {
                element.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
                element.style.transform = '';
                element.style.opacity = '';

                setTimeout(() => {
                    element.style.transition = '';
                }, 300);
            }

            isDragging = false;
        }, {
            passive: true
        });
    }

    function closePreviewCameraModal() {
        const modal = document.getElementById('previewCameraModal');
        const mobileModalContainer = modal.querySelector('.mobile-modal-container');
        const modalBackdrop = modal.querySelector('.modal-backdrop');
        const video = document.getElementById('previewVideo');
        const mobileVideo = document.getElementById('mobilePreviewVideo');
        const desktopModal = modal.querySelector('.md\\:block');

        if (mobileModalContainer) {
            mobileModalContainer.classList.remove('show');
            mobileModalContainer.classList.add('hide');
        }

        if (desktopModal) {
            desktopModal.style.opacity = '0';
            desktopModal.style.transform = 'translateY(-30px)';
            desktopModal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }

        modalBackdrop.classList.remove('show');

        // Stop all video tracks
        if (window.stream) {
            window.stream.getTracks().forEach(track => track.stop());
            window.stream = null;
            if (video.srcObject) video.srcObject = null;
            if (mobileVideo.srcObject) mobileVideo.srcObject = null;
        }

        const captureButton = document.getElementById('previewCaptureButton');
        const mobileCaptureButton = document.getElementById('mobilePreviewCaptureButton');
        if (captureButton) captureButton.removeEventListener('click', startPhotoSession);
        if (mobileCaptureButton) mobileCaptureButton.removeEventListener('click', startPhotoSession);
        window.removeEventListener('click', handleModalBackdropClick);

        resetModalState();
        document.body.classList.remove('modal-open');

        setTimeout(() => {
            modal.style.display = 'none';
            if (mobileModalContainer) {
                mobileModalContainer.classList.remove('hide');
            }
            if (desktopModal) {
                desktopModal.style.opacity = '';
                desktopModal.style.transform = '';
                desktopModal.style.transition = '';
            }
        }, 300);

        console.log('Modal closed and camera stream stopped');
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
        const toggleButton = document.getElementById('toggleCameraButton');
        const cameraIcon = document.getElementById('cameraIcon');

        currentFacingMode = 'user';
        isTogglingCamera = false;

        window.photoSlots = [];
        window.mobilePhotoSlots = [];

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

        if (toggleButton) {
            toggleButton.disabled = false;
            toggleButton.removeEventListener('click', toggleCamera);
        }
        if (cameraIcon) {
            cameraIcon.style.opacity = '1';
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

        const existingSlots = frameElement.querySelectorAll('.photo-slot');
        existingSlots.forEach(slot => slot.remove());

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
        const photoslots = isMobile ? window.mobilePhotoSlots : window.photoSlots;

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

                if (data.price > 0) {
                    const price = new Intl.NumberFormat('id-ID').format(data.price);
                    toastr.info(`Frame ini memerlukan pembayaran sebesar ${price} IDR untuk penggunaan penuh.`,
                        'Frame Premium', {
                            "timeOut": "4000",
                            "positionClass": "toast-top-center"
                        });
                }

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
        video.style.display = 'none';
        const errorMessage = document.createElement('div');
        errorMessage.className = 'flex flex-col items-center justify-center w-full h-full text-red-500';
        errorMessage.innerHTML = `
            <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <p>Gagal mengakses kamera. Silakan periksa izin kamera atau coba browser lain.</p>
        `;
        video.parentElement.appendChild(errorMessage);
        captureButton.disabled = true;
        captureButton.textContent = 'Kamera Tidak Tersedia';
    }

    function initializeToggleFilter() {
        const toggleButtons = document.querySelectorAll('#toggleFilter');

        toggleButtons.forEach(toggleButton => {
            const isMobile = toggleButton.closest('.block.sm\\:hidden') !== null;
            let filterOptions;

            if (isMobile) {
                filterOptions = toggleButton.closest('.block.sm\\:hidden').querySelector('#filterOptions');
            } else {
                const buttonContainer = toggleButton.closest('.flex.items-center.gap-4');
                filterOptions = buttonContainer ? buttonContainer.querySelector('#filterOptions') : null;
            }

            const filterArrow = toggleButton.querySelector('#filterArrow');

            if (!toggleButton || !filterOptions || !filterArrow) {
                console.warn('Toggle filter elements not found for button:', {
                    toggleButton: !!toggleButton,
                    filterOptions: !!filterOptions,
                    filterArrow: !!filterArrow,
                    isMobile: isMobile
                });
                return;
            }

            console.log('Initializing toggle for:', isMobile ? 'Mobile' : 'Desktop', {
                button: toggleButton,
                options: filterOptions
            });

            if (isFilterOpen) {
                showFilterOptions(filterOptions, filterArrow, toggleButton, isMobile);
            } else {
                hideFilterOptions(filterOptions, filterArrow, toggleButton, isMobile);
            }

            const newToggleButton = toggleButton.cloneNode(true);
            toggleButton.parentNode.replaceChild(newToggleButton, toggleButton);

            newToggleButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const currentlyOpen = !filterOptions.classList.contains('hidden');
                isFilterOpen = !currentlyOpen;

                const newFilterArrow = newToggleButton.querySelector('#filterArrow');

                if (!currentlyOpen) {
                    showFilterOptions(filterOptions, newFilterArrow, newToggleButton, isMobile);
                } else {
                    hideFilterOptions(filterOptions, newFilterArrow, newToggleButton, isMobile);
                }

                console.log('Filter options toggled:', isFilterOpen ? 'shown' : 'hidden');
            });

            document.addEventListener('click', function(e) {
                const isClickInsideFilter = newToggleButton.contains(e.target) ||
                    filterOptions.contains(e.target) ||
                    e.target.closest(
                        '.rating-filter-btn, .mobile-rating-filter-btn, .popular-filter-btn, .mobile-popular-filter-btn, .default-filter-btn, .mobile-default-filter-btn'
                    );

                if (!isClickInsideFilter && !e.target.closest('[class*="filter-btn"]')) {
                    const newFilterArrow = newToggleButton.querySelector('#filterArrow');
                    isFilterOpen = false;
                    hideFilterOptions(filterOptions, newFilterArrow, newToggleButton, isMobile);
                    console.log('Filter options closed due to outside click');
                }
            });

            console.log('Toggle filter initialized successfully for button');
        });
    }

    function showFilterOptions(filterOptions, filterArrow, toggleButton, isMobile) {
        filterOptions.classList.remove('hidden');
        if (isMobile) {
            filterOptions.classList.add('animate-fade-in');
        } else {
            filterOptions.classList.add('flex', 'animate-fade-in');
        }

        if (filterArrow) {
            filterArrow.style.transform = 'rotate(180deg)';
        }
        toggleButton.classList.add('bg-[#BF3131]', 'text-white', 'border-[#BF3131]');
        toggleButton.classList.remove('bg-gradient-to-r', 'from-gray-100', 'to-gray-200', 'text-gray-700',
            'border-gray-300');
    }

    function hideFilterOptions(filterOptions, filterArrow, toggleButton, isMobile) {
        filterOptions.classList.add('hidden');
        filterOptions.classList.remove('animate-fade-in');
        if (!isMobile) {
            filterOptions.classList.remove('flex');
        }

        if (filterArrow) {
            filterArrow.style.transform = 'rotate(0deg)';
        }
        toggleButton.classList.remove('bg-[#BF3131]', 'text-white', 'border-[#BF3131]');
        toggleButton.classList.add('bg-gradient-to-r', 'from-gray-100', 'to-gray-200', 'text-gray-700',
            'border-gray-300');
    }

    function attachAllListeners() {
        console.log('Attaching all listeners...');

        const categoryLinks = document.querySelectorAll('.category-btn, .category-btn-mobile');
        categoryLinks.forEach(link => {
            const newLink = link.cloneNode(true);
            link.parentNode.replaceChild(newLink, link);

            newLink.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                console.log('Category filter clicked:', url);
                handleFilterRequest(url, 'category');
            });
        });

        const filterLinks = document.querySelectorAll(
            '.filter-btn, .mobile-filter-btn, ' +
            '.rating-filter-btn, .mobile-rating-filter-btn, ' +
            '.popular-filter-btn, .mobile-popular-filter-btn, ' +
            '.default-filter-btn, .mobile-default-filter-btn'
        );

        filterLinks.forEach(link => {
            const newLink = link.cloneNode(true);
            link.parentNode.replaceChild(newLink, link);

            newLink.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const url = this.getAttribute('href');
                console.log('Filter clicked:', url);

                let filterType = 'filter';
                if (this.classList.contains('rating-filter-btn') || this.classList.contains(
                        'mobile-rating-filter-btn')) {
                    filterType = 'rating';
                } else if (this.classList.contains('popular-filter-btn') || this.classList.contains(
                        'mobile-popular-filter-btn')) {
                    filterType = 'popularitas';
                } else if (this.classList.contains('default-filter-btn') || this.classList.contains(
                        'mobile-default-filter-btn')) {
                    filterType = 'default';
                }

                isFilterOpen = true;
                handleFilterRequest(url, filterType);
            });
        });

        initializeToggleFilter();
        console.log('All listeners attached successfully');
    }

    function handleFilterRequest(url, filterType = 'filter') {
        if (!url) {
            console.error('No URL provided for filter request');
            return;
        }

        const scrollPosition = window.scrollY;
        console.log(`${filterType} filter clicked:`, url);

        showLoadingIndicator(filterType);

        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Cache-Control': 'no-cache'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                return new Promise(resolve => {
                    setTimeout(() => resolve(html), 300);
                });
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('.content_section');

                if (newContent) {
                    const currentContent = document.querySelector('.content_section');
                    if (currentContent) {
                        currentContent.style.transition = 'opacity 0.3s ease';
                        currentContent.style.opacity = '0';

                        setTimeout(() => {
                            currentContent.outerHTML = newContent.outerHTML;
                            window.history.pushState({}, '', url);
                            window.scrollTo(0, scrollPosition);
                            attachAllListeners();
                            if (typeof setupFrameCards === 'function') {
                                setupFrameCards();
                            }

                            const updatedContent = document.querySelector('.content_section');
                            if (updatedContent) {
                                updatedContent.style.opacity = '0';
                                updatedContent.style.transition = 'opacity 0.3s ease';
                                setTimeout(() => {
                                    updatedContent.style.opacity = '1';
                                }, 50);
                            }

                            hideLoadingIndicator();
                            console.log('Content updated successfully, filter state maintained');
                        }, 300);
                    } else {
                        console.error('Current content_section not found');
                        hideLoadingIndicator();
                        window.history.pushState({}, '', url);
                        console.error('Failed to update content section');
                    }
                } else {
                    console.error('New content_section not found in response');
                    hideLoadingIndicator();
                    window.history.pushState({}, '', url);
                    updateCategorySelection(url);
                    displayNoFramesMessage(url);
                    console.log('Displayed no frames message');
                }
            })
            .catch(error => {
                console.error(`Error fetching ${filterType}:`, error);
                hideLoadingIndicator();
                window.history.pushState({}, '', url);
                updateCategorySelection(url);
                displayNoFramesMessage(url);
                console.log('Displayed no frames message due to fetch error');
            });
    }

    function updateCategorySelection(url) {
        const urlObj = new URL(url, window.location.origin);
        const categoryId = urlObj.searchParams.get('category');

        console.log('Updating category selection for categoryId:', categoryId);

        const allCategoryBtns = document.querySelectorAll(
            '.category-btn .category-icon, .category-btn-mobile .category-icon-mobile');
        allCategoryBtns.forEach(btn => {
            btn.classList.remove('active');
        });

        if (categoryId) {
            const selectedCategoryBtns = document.querySelectorAll(`a[href*="category=${categoryId}"]`);
            selectedCategoryBtns.forEach(link => {
                const categoryIcon = link.querySelector('.category-icon, .category-icon-mobile');
                if (categoryIcon) {
                    categoryIcon.classList.add('active');
                    console.log('Added active class to category icon for categoryId:', categoryId);
                }
            });
        } else {
            const allCategoryLinks = document.querySelectorAll('a[href*="frametemp"]');
            allCategoryLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && !href.includes('category=')) {
                    const categoryIcon = link.querySelector('.category-icon, .category-icon-mobile');
                    if (categoryIcon) {
                        categoryIcon.classList.add('active');
                        console.log('Added active class to "Semua" category icon');
                    }
                }
            });
        }
    }

    function displayNoFramesMessage(url) {
        const framesSection = document.querySelector('.mt-12');
        if (!framesSection) return;

        const urlObj = new URL(url, window.location.origin);
        const categoryId = urlObj.searchParams.get('category');

        let categoryName = 'ini';
        if (categoryId) {
            const categoryLinks = document.querySelectorAll(`a[href*="category=${categoryId}"]`);
            for (let link of categoryLinks) {
                const categoryLabel = link.querySelector('.category-label, .category-label-mobile');
                if (categoryLabel) {
                    categoryName = `"${categoryLabel.textContent.trim()}"`;
                    console.log('Found category name:', categoryName);
                    break;
                }
            }
        }

        framesSection.innerHTML = `
        <div class="text-center py-20 bg-[#FEF3E2] rounded-2xl">
            <div class="inline-block text-7xl mb-6">😥</div>
            <p class="text-xl text-gray-600 font-light">
                Tidak ada frame yang tersedia untuk kategori ${categoryName}.
            </p>
            <p class="mt-3 text-gray-500">Silakan pilih kategori lain atau kembali lagi nanti.</p>
        </div>
    `;
    }

    function showLoadingIndicator(filterType = 'filter') {
        const framesSection = document.querySelector('.mt-12');
        if (framesSection) {
            framesSection.setAttribute('data-original-content', framesSection.innerHTML);

            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = urlParams.get('category');
            let categoryName = 'ini';
            if (categoryId) {
                const activeCategory = document.querySelector(
                    `.category-btn[data-category-id="${categoryId}"] .category-label, .category-btn-mobile[data-category-id="${categoryId}"] .category-label-mobile`
                );
                categoryName = activeCategory ? activeCategory.textContent : 'Unknown Category';
            }

            let loadingMessage = 'Memuat Frame...';
            switch (filterType) {
                case 'category':
                    loadingMessage = `Memuat Kategori "${categoryName}"...`;
                    break;
                case 'rating':
                    loadingMessage = 'Mengurutkan Rating...';
                    break;
                case 'popularitas':
                    loadingMessage = 'Mengurutkan Popularitas...';
                    break;
                case 'default':
                    loadingMessage = 'Memuat Urutan Default...';
                    break;
            }

            const loadingHTML = `
            <div id="frames-loading-overlay" class="relative">
                <div class="absolute inset-0 bg-white/80 backdrop-blur-sm z-10 rounded-2xl"></div>
                <div class="relative z-20 text-center py-32 bg-[#FEF3E2]">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="animate-spin rounded-full h-16 w-16 border-4 border-gray-200"></div>
                            <div class="animate-spin rounded-full h-16 w-16 border-4 border-[#BF3131] border-t-transparent absolute top-0 left-0"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold text-gray-800">${loadingMessage}</h3>
                    </div>
                </div>
            </div>
            <style>
                @keyframes loading-progress {
                    0% { width: 0%; }
                    50% { width: 100%; }
                    100% { width: 0%; }
                }
            </style>
        `;
            framesSection.innerHTML = loadingHTML;
            framesSection.style.transition = 'all 0.3s ease';
        }
    }

    function hideLoadingIndicator() {
        const loadingOverlay = document.getElementById('frames-loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }

    function toggleCamera() {
        if (isTogglingCamera) return;

        isTogglingCamera = true;
        const toggleButton = document.getElementById('toggleCameraButton');
        const cameraIcon = document.getElementById('cameraIcon');
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

    function clearDownloadedData() {
        try {
            const downloadedStatusLS = localStorage.getItem('pendingPayment');
            const status = JSON.parse(downloadedStatusLS || '{}');
            if (status.status === 'downloaded') {
                console.log('Found downloaded status, clearing data...');
                localStorage.removeItem('downloadStatus');
                localStorage.removeItem('pendingPayment');
                console.log('Downloaded data cleared successfully');
            }
        } catch (error) {
            console.error('Error clearing downloaded data:', error);
            localStorage.removeItem('downloadStatus');
            localStorage.removeItem('pendingPayment');
        }
    }

    function resetPaymentDropdown() {
        const paymentMethod = document.getElementById('paymentMethod');
        const paymentDetailsContainer = document.getElementById('paymentDetailsContainer');
        const bankTransferDetails = document.getElementById('bankTransferDetails');
        const qrisDetails = document.getElementById('qrisDetails');

        // Reset dropdown ke nilai default
        paymentMethod.value = '';

        // Sembunyikan container detail pembayaran
        paymentDetailsContainer.classList.add('hidden');

        // Sembunyikan semua metode pembayaran
        bankTransferDetails.style.display = 'none';
        qrisDetails.style.display = 'none';
    }

    // Handle backdrop click for accept and reject modals
    document.getElementById('acceptModal').addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            redirectToBooth(); // Redirect to booth on backdrop click for accept modal
        }
    });

    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            closeRejectModal(); // Close reject modal on backdrop click
        }
    });
    // Tambahkan di bagian script Anda
    document.addEventListener('DOMContentLoaded', function() {
        const qrisContainer = document.getElementById('qrisContainer');
        const qrisModal = document.getElementById('qrisModal');
        const qrisModalImg = document.getElementById('qrisModalImg');
        const closeQrisModal = document.getElementById('closeQrisModal');

        if (qrisContainer) {
            qrisContainer.addEventListener('click', function() {
                qrisModal.classList.add('show');
                document.body.classList.add('modal-open');
            });
        }

        if (closeQrisModal) {
            closeQrisModal.addEventListener('click', function() {
                qrisModal.classList.remove('show');
                document.body.classList.remove('modal-open');
            });
        }

        if (qrisModal) {
            qrisModal.addEventListener('click', function(e) {
                if (e.target === qrisModal) {
                    qrisModal.classList.remove('show');
                    document.body.classList.remove('modal-open');
                }
            });
        }
    });
</script>

@endsection
