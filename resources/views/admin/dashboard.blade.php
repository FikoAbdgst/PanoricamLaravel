@extends('layouts.app-admin')

@section('section')
    <!-- Wrapper untuk mengatur layout antara sidebar dan konten -->
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Konten Utama -->
        <div class="flex-1">
            <header class="bg-white shadow">
                <div class="py-3 px-3 sm:py-4 sm:px-4 md:px-6 lg:px-8">
                    <h1 class="text-xl sm:text-2xl font-bold">Dashboard</h1>
                    <p class="text-gray-600 text-xs sm:text-sm mt-1">{{ now()->format('l, d F Y') }}</p>
                </div>
            </header>

            <main class="p-3 sm:p-4 md:p-6 lg:p-8 bg-gray-50">
                @if (session('error'))
                    <div
                        class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 sm:px-4 sm:py-3 rounded mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Statistik Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-6 md:mb-8">
                    <!-- Total Transaksi -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Total Transaksi</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">
                                    {{ number_format($transactionStats['total']) }}</p>
                                <p class="text-xs text-blue-600">24 jam: +{{ $transactionStats['last_24h'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Transaksi -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-yellow-100 text-yellow-600 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Menunggu Approve</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">
                                    {{ number_format($transactionStats['pending']) }}</p>
                                <p class="text-xs text-yellow-600">Perlu ditinjau</p>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-green-100 text-green-600 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Revenue Hari Ini</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">Rp
                                    {{ number_format($revenueStats['today'], 0, ',', '.') }}</p>
                                <p class="text-xs text-green-600 truncate">Bulan ini: Rp
                                    {{ number_format($revenueStats['this_month'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimoni -->
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-purple-100 text-purple-600 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Testimoni</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">
                                    {{ number_format($testimoniStats['total']) }}</p>
                                <p class="text-xs text-purple-600">Rating: {{ $testimoniStats['average_rating'] }}/5 ⭐</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 sm:gap-6 md:gap-8 mb-6 md:mb-8">
                    <!-- Transaksi Pending -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">Transaksi Menunggu Approve</h3>
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full self-start sm:self-auto">
                                    {{ $transactionStats['pending'] }} pending
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            @if ($pendingTransactions->count() > 0)
                                <div class="space-y-3 sm:space-y-4">
                                    @foreach ($pendingTransactions->take(5) as $transaction)
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 bg-yellow-50 rounded-lg border border-yellow-200 gap-3 sm:gap-0">
                                            <div class="min-w-0 flex-1">
                                                <p class="font-medium text-gray-900 text-sm sm:text-base">
                                                    #{{ $transaction->order_id }}</p>
                                                <p class="text-sm text-gray-600 truncate">
                                                    {{ $transaction->frame->name ?? 'Frame tidak tersedia' }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $transaction->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="flex flex-col sm:text-right gap-2">
                                                <p class="font-semibold text-gray-900 text-sm sm:text-base">Rp
                                                    {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <button onclick="approveTransaction({{ $transaction->id }})"
                                                        class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                        Approve
                                                    </button>
                                                    <button onclick="rejectTransaction({{ $transaction->id }})"
                                                        class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition-colors">
                                                        Reject
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($pendingTransactions->count() > 5)
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('admin.transactions.index') }}?status=pending"
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            Lihat semua {{ $pendingTransactions->count() }} transaksi pending →
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-6 sm:py-8">
                                    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Tidak ada transaksi yang menunggu approve</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Activity 24 Jam -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">Aktivitas 24 Jam Terakhir</h3>
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full self-start sm:self-auto">
                                    {{ $transactionStats['last_24h'] + $testimoniStats['last_24h'] }} aktivitas
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="space-y-3 sm:space-y-4">
                                <!-- Recent Transactions -->
                                @foreach ($recentTransactions as $transaction)
                                    <div class="flex items-start sm:items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Transaksi baru
                                                #{{ $transaction->order_id }}</p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $transaction->frame->name ?? 'Frame tidak tersedia' }} - Rp
                                                {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 sm:px-2.5 rounded-full text-xs font-medium
                                                {{ $transaction->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $transaction->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Recent Testimoni -->
                                @foreach ($recentTestimoni->take(3) as $testimoni)
                                    <div class="flex items-start sm:items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-7 h-7 sm:w-8 sm:h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-purple-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">Testimoni baru dari
                                                {{ $testimoni->name }}</p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ Str::limit($testimoni->message, 50) }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                            <a href="{{ route('admin.categories.index') }}"
                                class="bg-purple-100 p-4 rounded-lg hover:bg-purple-200 transition-colors">
                                <h3 class="font-bold text-base sm:text-lg text-purple-800">Kelola Kategori</h3>
                                <p class="text-purple-600 text-sm mt-1">Tambah, edit, dan hapus kategori untuk frame
                                    photobooth.</p>
                            </a>

                            <a href="{{ route('admin.frames.index') }}"
                                class="bg-blue-100 p-4 rounded-lg hover:bg-blue-200 transition-colors">
                                <h3 class="font-bold text-base sm:text-lg text-blue-800">Kelola Frame</h3>
                                <p class="text-blue-600 text-sm mt-1">Tambah, edit, dan hapus frame untuk photobooth.</p>
                            </a>

                            <a href="{{ route('admin.testimoni.index') }}"
                                class="bg-green-100 p-4 rounded-lg hover:bg-green-200 transition-colors sm:col-span-2 lg:col-span-1">
                                <h3 class="font-bold text-base sm:text-lg text-green-800">Kelola Testimoni</h3>
                                <p class="text-green-600 text-sm mt-1">Hapus testimoni dari pengguna.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts untuk approve/reject -->
    <script>
        async function approveTransaction(id) {
            if (!confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')) return;

            try {
                const response = await fetch(`/admin/transactions/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan saat memproses transaksi.');
            }
        }

        async function rejectTransaction(id) {
            if (!confirm('Apakah Anda yakin ingin menolak transaksi ini?')) return;

            try {
                const response = await fetch(`/admin/transactions/${id}/reject`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan saat memproses transaksi.');
            }
        }
    </script>
@endsection
