@extends('layouts.app-admin')

@section('title', 'Kelola Testimoni')

@section('section')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="container mx-auto px-6 py-8">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Kelola Frame</h1>
                        <p class="text-gray-600 text-sm sm:text-base">Kelola dan pantau semua frame produk Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                        <div class="bg-white rounded-lg px-4 py-2 shadow-sm border text-center sm:text-left">
                            <span class="text-sm text-gray-500">Total Testimoni</span>
                            <div class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $testimonis ? $testimonis->count() : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filter dan Search Bar -->
            <div class="bg-white rounded-xl shadow-sm mb-6 p-6">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari testimoni..."
                                class="pl-10 pr-4 py-2 w-full md:w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <select id="ratingFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Rating</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang
                                ({{ $testimonis ? $testimonis->where('rating', 5)->count() : 0 }})</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang
                                ({{ $testimonis ? $testimonis->where('rating', 4)->count() : 0 }})</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang
                                ({{ $testimonis ? $testimonis->where('rating', 3)->count() : 0 }})</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang
                                ({{ $testimonis ? $testimonis->where('rating', 2)->count() : 0 }})</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang
                                ({{ $testimonis ? $testimonis->where('rating', 1)->count() : 0 }})</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <div class="mt-4 text-sm text-gray-600">
                            Menampilkan <span id="visibleCount">{{ $testimonis ? $testimonis->count() : 0 }}</span> dari
                            {{ $testimonis ? $testimonis->count() : 0 }} testimoni
                        </div>
                    </div>
                </div>

            </div>

            <!-- Testimoni Cards -->
            <div id="testimoniContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($testimonis as $testimoni)
                    <div class="testimoni-card bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden group"
                        data-name="{{ strtolower($testimoni->name) }}"
                        data-message="{{ strtolower($testimoni->message) }}" data-rating="{{ $testimoni->rating }}">
                        <!-- Card Header -->
                        <div class="p-6 pb-4">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($testimoni->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $testimoni->name }}</h3>
                                        <p class="text-sm text-gray-500">Pelanggan</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-1 text-sm font-medium text-gray-600">{{ $testimoni->rating }}/5</span>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <p class="text-gray-700 leading-relaxed line-clamp-3">
                                    "{{ $testimoni->message }}"
                                </p>
                                @if (strlen($testimoni->message) > 100)
                                    <button
                                        onclick="showFullMessage('{{ addslashes($testimoni->message) }}', '{{ $testimoni->name }}')"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 transition-colors duration-200">
                                        Baca selengkapnya
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $testimoni->created_at ? $testimoni->created_at->format('d M Y') : 'N/A' }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200 flex items-center gap-1"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni dari {{ $testimoni->name }}?')">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full" id="emptyState">
                        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m0 0V6a2 2 0 012-2h10a2 2 0 012 2v2M9 12h6m-6 4h6">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada testimoni</h3>
                            <p class="text-gray-500 mb-6">Testimoni dari pelanggan akan ditampilkan di sini</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- No Results State -->
            <div id="noResultsState" class="hidden">
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada hasil pencarian</h3>
                    <p class="text-gray-500 mb-6">Coba gunakan kata kunci yang berbeda atau filter lainnya</p>
                    <button onclick="clearFilters()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Message Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-screen overflow-hidden shadow-2xl">
            <div
                class="flex justify-between items-center p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <h3 class="text-xl font-semibold text-gray-900">Testimoni Lengkap</h3>
                <button onclick="closeMessageModal()"
                    class="p-2 hover:bg-gray-100 rounded-full transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <h4 class="text-lg font-medium text-gray-900" id="modalCustomerName"></h4>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed" id="modalFullMessage"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Combined search and filter functionality
        function filterTestimoni() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedRating = document.getElementById('ratingFilter').value;
            const cards = document.querySelectorAll('.testimoni-card');
            const emptyState = document.getElementById('emptyState');
            const noResultsState = document.getElementById('noResultsState');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.dataset.name;
                const message = card.dataset.message;
                const rating = card.dataset.rating;

                const matchesSearch = name.includes(searchTerm) || message.includes(searchTerm);
                const matchesRating = !selectedRating || rating === selectedRating;

                if (matchesSearch && matchesRating) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update visible count
            document.getElementById('visibleCount').textContent = visibleCount;

            // Show/hide states
            if (visibleCount === 0 && cards.length > 0) {
                noResultsState.classList.remove('hidden');
                if (emptyState) emptyState.style.display = 'none';
            } else {
                noResultsState.classList.add('hidden');
                if (emptyState && cards.length === 0) emptyState.style.display = '';
            }
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterTestimoni);
        document.getElementById('ratingFilter').addEventListener('change', function() {
            const selectedRating = this.value;
            if (selectedRating) {
                const url = new URL(window.location);
                url.searchParams.set('rating', selectedRating);
                window.history.pushState({}, '', url);
            } else {
                const url = new URL(window.location);
                url.searchParams.delete('rating');
                window.history.pushState({}, '', url);
            }
            filterTestimoni();
        });

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('ratingFilter').value = '';

            // Remove rating parameter from URL
            const url = new URL(window.location);
            url.searchParams.delete('rating');
            window.history.pushState({}, '', url);

            filterTestimoni();
        }

        function showFullMessage(message, customerName) {
            document.getElementById('modalCustomerName').textContent = customerName;
            document.getElementById('modalFullMessage').textContent = message;
            document.getElementById('messageModal').classList.remove('hidden');
            document.getElementById('messageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
            document.getElementById('messageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMessageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMessageModal();
            }
        });

        // Auto-hide success message
        setTimeout(function() {
            const successAlert = document.querySelector('.bg-green-50');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s ease-out';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }
        }, 5000);
    </script>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
