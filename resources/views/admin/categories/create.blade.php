@extends('layouts.app-admin')

@section('section')
    <div class="flex-1 min-h-screen bg-gray-50">
        <!-- Header with gradient background -->
        <header class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">Tambah Kategori Baru</h1>
                        <p class="mt-1 text-blue-100">Buat kategori baru untuk mengorganisir konten</p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="flex items-center space-x-2 text-blue-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="text-sm">Kategori Baru</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="px-4 py-6 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan dalam form</h3>
                        </div>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Kategori</h2>
                        <p class="mt-1 text-sm text-gray-600">Lengkapi informasi untuk kategori baru</p>
                    </div>

                    <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf

                        <!-- Category Name Field -->
                        <div class="space-y-2">
                            <label for="name" class="flex items-center text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Nama Kategori
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                value="{{ old('name') }}" required placeholder="Masukkan nama kategori">
                        </div>

                        <!-- Icon Field -->
                        <div class="space-y-2">
                            <label for="icon" class="flex items-center text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-7 4h12a2 2 0 002-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
                                </svg>
                                Icon Kategori
                            </label>
                            <div class="relative">
                                <input type="text" name="icon" id="icon"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    value="{{ old('icon') }}" required placeholder="📷">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-400 text-sm">Emoji</span>
                                </div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-sm text-blue-700">
                                    <span class="font-medium">💡 Tips:</span> Gunakan emoji yang sesuai dengan kategori.
                                    Contoh: 📷 untuk foto, 🎉 untuk acara, 👑 untuk premium, 🍕 untuk makanan
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="flex-1 sm:flex-initial bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Kategori
                                </span>
                            </button>
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex-1 sm:flex-initial bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition duration-200 ease-in-out text-center">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Batal
                                </span>
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Quick Actions -->
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Aksi Cepat</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition duration-200">
                            📋 Lihat Semua Kategori
                        </a>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✨ Tambah Kategori Baru
                        </span>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
