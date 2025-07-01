    @extends('layouts.app-admin')

    @section('title', 'Kelola Kategori')

    @section('section')
        <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="container mx-auto px-4 sm:px-6 py-6 sm:py-8">
                <!-- Header Section -->
                <div class="mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Kelola Kategori</h1>
                            <p class="text-gray-600 text-sm sm:text-base">Kelola dan pantau semua kategori produk Anda</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                            <div class="bg-white rounded-lg px-4 py-2 shadow-sm border text-center sm:text-left">
                                <span class="text-sm text-gray-500">Total Kategori</span>
                                <div class="text-xl sm:text-2xl font-bold text-gray-900">
                                    {{ $categories ? $categories->count() : 0 }}</div>
                            </div>
                            <a href="{{ route('admin.categories.create') }}"
                                class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 sm:px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Tambah Kategori Baru</span>
                                <span class="sm:hidden">Tambah Kategori</span>
                            </a>
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

                <!-- Search Bar -->
                <div class="bg-white rounded-xl shadow-sm mb-6 p-4 sm:p-6">
                    <div class="relative w-full">
                        <input type="text" id="searchInput" placeholder="Cari kategori..."
                            class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 text-center sm:text-left mt-3">
                        Menampilkan <span id="visibleCount">{{ $categories ? $categories->count() : 0 }}</span> dari
                        {{ $categories ? $categories->count() : 0 }} kategori
                    </div>
                </div>

                <!-- Category Cards -->
                <div id="categoryContainer"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 sm:gap-6">
                    @forelse ($categories as $category)
                        <div class="category-card bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group"
                            data-name="{{ strtolower($category->name) }}">

                            <!-- Category Icon/Header -->
                            <div
                                class="relative overflow-hidden bg-gradient-to-br from-purple-100 to-blue-100 h-32 sm:h-36">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div
                                            class="text-4xl sm:text-5xl mb-2 group-hover:scale-110 transition-transform duration-300">
                                            {{ $category->icon ?? '📁' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- ID Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs font-medium rounded bg-black bg-opacity-50 text-white">
                                        #{{ $category->id }}
                                    </span>
                                </div>

                                <!-- Frame Count Badge -->
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 shadow-sm">
                                        {{ $category->frames->count() }} Frame
                                    </span>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-4 sm:p-5">
                                <div class="text-center mb-4">
                                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg mb-1 line-clamp-2">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-500">
                                        {{ $category->frames->count() }}
                                        {{ $category->frames->count() == 1 ? 'frame tersedia' : 'frame tersedia' }}
                                    </p>
                                </div>

                                <!-- Quick Stats -->
                                <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                    <div class="flex justify-between items-center text-xs sm:text-sm">
                                        <span class="text-gray-600">Frame Gratis:</span>
                                        <span class="font-medium text-green-600">
                                            {{ $category->frames->where('price', 0)->count() }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center text-xs sm:text-sm mt-1">
                                        <span class="text-gray-600">Frame Berbayar:</span>
                                        <span class="font-medium text-blue-600">
                                            {{ $category->frames->where('price', '>', 0)->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Actions -->
                            <div class="px-4 py-3 sm:px-5 sm:py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="flex gap-2 flex-1">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                            class="flex-1 text-center bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-2 sm:px-3 rounded-lg text-xs sm:text-sm transition-colors duration-200 flex items-center justify-center gap-1">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 font-medium py-2 px-2 sm:px-3 rounded-lg text-xs sm:text-sm transition-colors duration-200 flex items-center justify-center gap-1"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}? Semua frame dalam kategori ini akan kehilangan kategori.')">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full" id="emptyState">
                            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                                <div
                                    class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada kategori</h3>
                                <p class="text-gray-500 mb-6">Kategori produk akan ditampilkan di sini setelah Anda
                                    menambahkannya</p>
                                <a href="{{ route('admin.categories.create') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Kategori Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- No Results State -->
                <div id="noResultsState" class="hidden">
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada hasil pencarian</h3>
                        <p class="text-gray-500 mb-6">Coba gunakan kata kunci yang berbeda</p>
                        <button onclick="clearSearch()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                            Reset Pencarian
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Search functionality
            function filterCategories() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const cards = document.querySelectorAll('.category-card');
                const emptyState = document.getElementById('emptyState');
                const noResultsState = document.getElementById('noResultsState');
                let visibleCount = 0;

                cards.forEach(card => {
                    const name = card.dataset.name;

                    if (name.includes(searchTerm)) {
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

            // Event listener
            document.getElementById('searchInput').addEventListener('input', filterCategories);

            function clearSearch() {
                document.getElementById('searchInput').value = '';
                filterCategories();
            }

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
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endsection
