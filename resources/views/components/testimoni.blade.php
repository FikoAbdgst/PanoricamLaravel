<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .testimonial-card {
            min-width: 380px;
            max-width: 380px;
            min-height: 320px;
            transition: all 0.4s ease;
            backdrop-filter: blur(15px);
            border: 3px solid #BF3131;
            position: relative;
            overflow: hidden;
            white-space: normal;
            /* Allow text wrapping inside cards */
            display: flex;
            flex-direction: column;
        }

        .testimonial-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 49, 49, 0.1), transparent);
            transition: left 0.5s;
        }

        .testimonial-card:hover::before {
            left: 100%;
        }

        .testimonial-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 25px 50px rgba(191, 49, 49, 0.25);
            border-color: #F16767;
        }

        .star-rating {
            color: #fbbf24;
            filter: drop-shadow(0 2px 4px rgba(251, 191, 36, 0.3));
        }

        .loading-spinner {
            border: 4px solid #FEF3E2;
            border-top: 4px solid #BF3131;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            padding: 3rem 0;
            background: #FEF3E2;
        }

        .marquee-content {
            display: inline-flex;
            gap: 2rem;
            animation: marquee 80s linear infinite;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .hero-bg {
            background: linear-gradient(135deg, #FEF3E2 0%, #fff 100%);
            position: relative;
        }

        .decorative-frame {
            position: absolute;
            background: white;
            border: 4px solid #BF3131;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(191, 49, 49, 0.15);
        }

        .frame-left {
            left: -2rem;
            top: 20%;
            transform: rotate(-6deg);
            width: 120px;
            height: 160px;
        }

        .frame-right {
            right: -2rem;
            bottom: 20%;
            transform: rotate(6deg);
            width: 120px;
            height: 160px;
        }

        .floating-star {
            position: absolute;
            color: #BF3131;
            opacity: 0.2;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #BF3131, #F16767);
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(191, 49, 49, 0.3);
        }

        .card-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
        }

        .emoji-badge {
            background: linear-gradient(135deg, #BF3131, #F16767);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(191, 49, 49, 0.3);
        }

        .message-text {
            line-height: 1.7;
            color: #4a5568;
            position: relative;
            word-wrap: break-word;
            /* Allow long words to break */
            overflow-wrap: break-word;
            /* Ensure text wraps properly */
            white-space: normal;
            /* Override parent's nowrap */
            hyphens: auto;
            /* Add hyphenation for better text flow */
        }

        .frame-info-badge {
            background: linear-gradient(135deg, #FEF3E2, #fff);
            width: 100%;
            height: fit-content;
            border: 2px solid #BF3131;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
        }

        .frame-info-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 49, 49, 0.1), transparent);
            transition: left 0.5s;
        }

        .frame-info-badge:hover {
            background: linear-gradient(135deg, #BF3131, #F16767);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(191, 49, 49, 0.3);
            border-color: #BF3131;
        }

        .frame-info-badge:hover .frame-icon {
            color: white;
        }

        .frame-info-badge:hover .frame-text {
            color: white;
        }

        .frame-info-badge:hover .frame-check {
            color: #10b981;
        }

        .frame-info-badge:active {
            transform: translateY(0px);
            box-shadow: 0 4px 12px rgba(191, 49, 49, 0.3);
        }

        /* Prevent testimonial card hover from affecting frame button when button is hovered */
        .testimonial-card:hover .frame-info-badge:not(:hover)::before {
            left: 100%;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
            margin: auto;
            padding: 2rem;
            border: 3px solid #BF3131;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
            transform: scale(0.7);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px rgba(191, 49, 49, 0.25);
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #FEF3E2;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #BF3131;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background-color: #BF3131;
            color: white;
            transform: rotate(90deg);
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #BF3131, #F16767);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(191, 49, 49, 0.7);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(191, 49, 49, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(191, 49, 49, 0);
            }
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #BF3131, #F16767);
            color: white;
            border: 2px solid transparent;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #F16767, #BF3131);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(191, 49, 49, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #BF3131;
            border: 2px solid #BF3131;
        }

        .btn-secondary:hover {
            background: #FEF3E2;
            transform: translateY(-2px);
        }

        .loading-overlay {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            z-index: 10;
        }

        .loading-overlay.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="hero-bg min-h-screen">

        <!-- Header -->
        <div class="text-center header-section bg-[#FEF3E2] py-20 relative" data-aos="fade-up">
            <div class="floating-elements">
                <i class="floating-star fas fa-star" style="top: 20%; left: 10%; animation-delay: 0s;"></i>
                <i class="floating-star fas fa-heart" style="top: 30%; right: 15%; animation-delay: 2s;"></i>
                <i class="floating-star fas fa-camera" style="bottom: 40%; left: 20%; animation-delay: 4s;"></i>
                <i class="floating-star fas fa-smile" style="top: 60%; right: 20%; animation-delay: 6s;"></i>
            </div>

            <h1 class="text-6xl font-extrabold text-gray-900 mb-8 tracking-tight" data-aos="fade-up">
                Apa Kata Mereka?
            </h1>
            <p class="text-gray-600 text-xl max-w-4xl mx-auto px-6 leading-relaxed" data-aos="fade-up">
                Kepuasan kamu adalah tujuan utama kami. Lihat cerita seru dari pengguna yang sudah mencoba PhotoBooth
                ini
                dan punya pengalaman seru yang nggak terlupakan!
            </p>
            <div class="mt-8" data-aos="fade-up">
                <div
                    class="inline-flex items-center space-x-2 bg-white rounded-full px-6 py-3 shadow-lg border-2 border-[#BF3131]">
                    <i class="fas fa-users text-[#BF3131]"></i>
                    <span class="font-semibold text-gray-700">1000+ Pelanggan Puas</span>
                    <i class="fas fa-heart text-red-500"></i>
                </div>
            </div>
        </div>

        <!-- Testimoni Marquee -->
        <div class="marquee-container relative bg-[#FEF3E2]" data-aos="fade-up">
            <div id="marqueeContent" class="marquee-content">
                <!-- Loading state -->
                <div class="flex justify-center items-center w-full" data-aos="fade-up">
                    <div class="loading-spinner"></div>
                    <p class="ml-4 text-[#BF3131] font-semibold">Memuat testimoni...</p>
                </div>
            </div>
        </div>

        <!-- Testimoni Section -->
        <div class="relative bg-gradient-to-br bg-[#FEF3E2] overflow-hidden" data-aos="fade-up">
            <!-- Background decorative elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    class="absolute -top-24 -left-24 w-96 h-96 bg-gradient-to-br from-[#BF3131] to-[#F16767] rounded-full opacity-5 animate-pulse">
                </div>
                <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-gradient-to-bl from-[#F16767] to-[#BF3131] rounded-full opacity-5 animate-pulse"
                    style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/4 w-4 h-4 bg-[#BF3131] rounded-full opacity-20 animate-bounce"
                    style="animation-delay: 0.5s;"></div>
                <div class="absolute top-1/3 right-1/3 w-3 h-3 bg-[#F16767] rounded-full opacity-20 animate-bounce"
                    style="animation-delay: 1.5s;"></div>
                <div class="absolute bottom-1/4 left-1/2 w-5 h-5 bg-[#BF3131] rounded-full opacity-20 animate-bounce"
                    style="animation-delay: 2s;"></div>
            </div>

            <!-- Company Slogan Section -->
            <div class="relative z-10 text-center py-16">
                <div class="max-w-6xl mx-auto px-6">
                    <!-- Main Slogan -->
                    <div class="mb-16">
                        <div class="inline-flex items-center justify-center mb-6" data-aos="flip-up"
                            data-aos-duration="800" data-aos-delay="100">
                            <div class="h-px bg-gradient-to-r from-transparent via-[#BF3131] to-transparent w-32"
                                data-aos="slide-right" data-aos-delay="200"></div>
                            <div class="mx-4 bg-white border-2 border-[#BF3131] rounded-full px-4 py-2"
                                data-aos="rotate-in" data-aos-duration="800" data-aos-delay="300">
                                <i class="fas fa-camera text-[#BF3131] text-lg"></i>
                            </div>
                            <div class="h-px bg-gradient-to-l from-transparent via-[#BF3131] to-transparent w-32"
                                data-aos="slide-left" data-aos-delay="400"></div>
                        </div>

                        <p class="text-2xl font-semibold text-gray-700 mb-2" data-aos="slide-up" data-aos-duration="800"
                            data-aos-delay="500">
                            "Setiap detik adalah kenangan, setiap foto adalah cerita"
                        </p>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed" data-aos="slide-up"
                            data-aos-duration="800" data-aos-delay="700">
                            Photobooth terdepan yang menghadirkan teknologi canggih dengan sentuhan kreativitas untuk
                            menciptakan momen tak terlupakan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="loading-overlay" id="modalLoading">
                <div class="loading-spinner"></div>
            </div>

            <div class="modal-header">
                <h2 class="text-2xl font-bold text-gray-800">Frame Berbayar</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <div class="text-center">
                <div class="modal-icon">
                    <i class="fas fa-credit-card text-white text-3xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Pembayaran Diperlukan</h3>
                <p class="text-gray-600 mb-2 leading-relaxed">
                    Frame ini berbayar, silahkan anda untuk melakukan pembayaran terlebih dahulu.
                </p>
                <div id="frameDetails" class="bg-[#FEF3E2] rounded-lg p-4 my-4 border-2 border-[#BF3131]">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-gray-700">Harga Frame:</span>
                        <span id="framePrice" class="text-[#BF3131] font-bold text-lg">-</span>
                    </div>
                </div>
            </div>

            <div class="modal-buttons">

                <button class="btn btn-primary" onclick="proceedPayment()">
                    <i class="fas fa-shopping-cart mr-2"></i>Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <script>
        let allTestimonis = [];
        let currentFrameId = null;

        // Load initial data
        document.addEventListener('DOMContentLoaded', function() {
            loadTestimonis();
        });

        // Load testimonials
        async function loadTestimonis() {
            try {
                const response = await fetch('/api/testimonis?per_page=50');
                const result = await response.json();

                if (result.success && result.data.data) {
                    allTestimonis = result.data.data;
                    displayMarqueeTestimonis(allTestimonis);
                } else {
                    loadMockData(); // Fallback to mock data
                }
            } catch (error) {
                console.error('Error loading testimonis:', error);
                loadMockData(); // Fallback to mock data
            }
        }

        // Display testimonials in marquee
        function displayMarqueeTestimonis(testimonis) {
            const container = document.getElementById('marqueeContent');

            if (testimonis.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 w-full">
                        <div class="text-[#BF3131] mb-4">
                            <i class="fas fa-comments text-6xl opacity-50"></i>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada testimoni tersedia.</p>
                    </div>
                `;
                return;
            }

            // Duplicate testimonials for seamless infinite loop
            const duplicatedTestimonis = [...testimonis, ...testimonis];

            container.innerHTML = duplicatedTestimonis.map(testimoni => createTestimoniCard(testimoni)).join('');
        }

        // Create testimonial card
        function createTestimoniCard(testimoni) {
            const date = new Date(testimoni.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const stars = generateStars(testimoni.rating);
            const emoji = testimoni.emoji || getRandomEmoji(testimoni.rating);

            return `
                <div class="testimonial-card card-gradient rounded-2xl py-7 px-10 shadow-xl mx-3 relative">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="profile-avatar rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-xl">${testimoni.name.charAt(0).toUpperCase()}</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg">${testimoni.name}</h4>
                                <p class="text-sm text-gray-500 font-medium">${date}</p>
                            </div>
                        </div>
                        <div class="emoji-badge">
                            ${emoji}
                        </div>
                    </div>
                    
                    <!-- Message (flexible content) -->
                    <div class="flex-grow mb-6">
                        <div class="relative">
                            <i class="fas fa-quote-left text-[#BF3131] text-2xl opacity-30 absolute -top-2 -left-1"></i>
                            <p class="message-text font-medium pl-6 pr-2 mt-4">${testimoni.message}</p>
                            <i class="fas fa-quote-right text-[#BF3131] text-2xl opacity-30 absolute -bottom-2 -right-1"></i>
                        </div>
                    </div>

                    <!-- Bottom section (fixed at bottom) -->
                    <div class="mt-auto">
                        <!-- Rating -->
                        <div class="flex justify-center items-center mb-4">
                            <div class="flex items-center bg-gradient-to-r from-yellow-50 to-orange-50 rounded-full px-4 py-2 border border-yellow-200 w-fit">
                                <div class="star-rating mr-3">${stars}</div>
                                <span class="text-sm font-semibold text-gray-700">(${testimoni.rating}/5)</span>
                            </div>
                        </div>
                        
                        <!-- Frame info -->
                        ${testimoni.frame ? `
                                                                                    <div class="frame-info-badge" onclick="handleFrameClickSimple(${testimoni.frame.id})">
                                                                                        <div class="flex items-center justify-center space-x-2">
                                                                                            <i class="fas fa-image frame-icon text-[#BF3131] transition-colors duration-300"></i>
                                                                                            <span class="text-sm font-semibold frame-text text-gray-700 transition-colors duration-300">
                                                                                                Frame: ${testimoni.frame.name}
                                                                                            </span>
                                                                                            <i class="fas fa-check-circle frame-check text-green-500 text-sm transition-colors duration-300"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                ` : ''}
                    </div>
                </div>
            `;
        }

        function handleFrameClickSimple(frameId) {
            currentFrameId = frameId;

            // Cari frame dari data testimoni
            const testimoni = allTestimonis.find(t => t.frame && t.frame.id == frameId);

            if (testimoni && testimoni.frame) {
                const price = Number(testimoni.frame.price);
                console.log('Frame price:', price, typeof price);

                if (price === 0) {
                    console.log('Free frame detected, redirecting...');
                    window.location.href = `/booth?frame_id=${frameId}`;
                    return;
                }
            }

            // Jika tidak gratis atau tidak ketemu, tampilkan modal
            console.log('Paid frame or unknown, showing modal...');
            showModal();

            // Set harga dari data lokal jika ada
            if (testimoni && testimoni.frame && testimoni.frame.price > 0) {
                document.getElementById('framePrice').textContent =
                    `Rp ${testimoni.frame.price.toLocaleString('id-ID')}`;
            } else {
                document.getElementById('framePrice').textContent = 'Hubungi Admin';
            }
        }

        // Show modal
        function showModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);

            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('paymentModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);

            currentFrameId = null;
        }

        // Show modal loading
        function showModalLoading() {
            document.getElementById('modalLoading').classList.add('show');
        }

        // Hide modal loading
        function hideModalLoading() {
            document.getElementById('modalLoading').classList.remove('show');
        }

        function proceedPayment() {
            if (currentFrameId) {
                // Cari data frame dari testimoni
                const testimoni = allTestimonis.find(t => t.frame && t.frame.id == currentFrameId);
                let framePrice = 0;
                let frameImageUrl = '';

                if (testimoni && testimoni.frame) {
                    framePrice = testimoni.frame.price;
                    // Prepend base URL to image_path, or use placeholder if image_path is missing
                    frameImageUrl = testimoni.frame.image_path ?
                        `http://127.0.0.1:8000/storage/${testimoni.frame.image_path}` :
                        'https://via.placeholder.com/60x60/BF3131/FFFFFF?text=Frame';
                } else {
                    // Jika tidak ketemu di testimoni, ambil dari modal display
                    const priceText = document.getElementById('framePrice').textContent;
                    // Extract number from "Rp 25.000" format
                    const priceMatch = priceText.match(/[\d.,]+/);
                    if (priceMatch) {
                        framePrice = parseInt(priceMatch[0].replace(/[.,]/g, ''));
                    }
                    // Fallback image URL with placeholder
                    frameImageUrl = 'https://via.placeholder.com/60x60/BF3131/FFFFFF?text=Frame';
                }

                // Simpan data pembayaran ke localStorage
                const paymentData = {
                    frame_id: currentFrameId,
                    price: framePrice,
                    frame_image: frameImageUrl,
                    timestamp: Date.now()
                };

                try {
                    localStorage.setItem('pendingPremiumFrame', JSON.stringify(paymentData));
                    console.log('Payment data saved:', paymentData);
                } catch (error) {
                    console.error('Error saving to localStorage:', error);
                }

                // Redirect ke halaman booth dengan frame_id
                window.location.href = `/booth?frame_id=${currentFrameId}`;
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('paymentModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Generate stars
        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else {
                    stars += '<i class="far fa-star text-gray-300"></i>';
                }
            }
            return stars;
        }

        // Get random emoji based on rating
        function getRandomEmoji(rating) {
            const emojisByRating = {
                5: ['😍', '🤩', '⭐', '🎉', '💖', '👏'],
                4: ['😊', '👍', '😄', '🙂', '💙'],
                3: ['😐', '👌', '🙂'],
                2: ['😕', '👎'],
                1: ['😞', '👎', '😔']
            };

            const emojis = emojisByRating[rating] || emojisByRating[5];
            return emojis[Math.floor(Math.random() * emojis.length)];
        }

        // Load mock data for demo
        function loadMockData() {
            const mockTestimonis = [{
                    id: 1,
                    name: "Sarah Johnson",
                    message: "PhotoBooth ini sangat keren! Hasil fotonya berkualitas tinggi dan framenya beragam. Sangat puas dengan pelayanannya!",
                    rating: 5,
                    created_at: new Date().toISOString(),
                    frame: {
                        id: 1,
                        name: "Wedding Classic",
                        price: 25000,
                        isFree: false
                    }
                },
                {
                    id: 2,
                    name: "Michael Chen",
                    message: "Pengalaman yang luar biasa! Frame gratis sudah bagus, tapi frame premium benar-benar worth it. Recommended!",
                    rating: 5,
                    created_at: new Date(Date.now() - 86400000).toISOString(),
                    frame: {
                        id: 2,
                        name: "Basic Frame",
                        price: 0,
                        isFree: true
                    }
                },
                {
                    id: 3,
                    name: "Lisa Amanda",
                    message: "Suka banget dengan hasilnya! Framenya lucu-lucu dan cocok untuk acara ulang tahun. Terima kasih!",
                    rating: 4,
                    created_at: new Date(Date.now() - 172800000).toISOString(),
                    frame: {
                        id: 3,
                        name: "Birthday Fun",
                        price: 15000,
                        isFree: false
                    }
                },
                {
                    id: 4,
                    name: "David Pratama",
                    message: "Frame gratisnya sudah bagus banget! Kualitas foto juga oke. Thanks PhotoBooth!",
                    rating: 5,
                    created_at: new Date(Date.now() - 259200000).toISOString(),
                    frame: {
                        id: 4,
                        name: "Simple & Clean",
                        price: 0,
                        isFree: true
                    }
                },
                {
                    id: 5,
                    name: "Maria Santos",
                    message: "Frame premium memang beda! Detail dan kualitasnya sangat memuaskan. Worth every penny!",
                    rating: 5,
                    created_at: new Date(Date.now() - 345600000).toISOString(),
                    frame: {
                        id: 5,
                        name: "Premium Gold",
                        price: 50000,
                        isFree: false
                    }
                }
            ];

            allTestimonis = mockTestimonis;
            displayMarqueeTestimonis(allTestimonis);
        }

        // Auto-load mock data for demo
        setTimeout(() => {
            if (allTestimonis.length === 0) {
                loadMockData();
            }
        }, 2000);
    </script>
