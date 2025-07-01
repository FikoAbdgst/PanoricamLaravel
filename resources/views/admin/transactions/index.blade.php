@extends('layouts.app-admin')

@section('title', 'Kelola Transaksi')

@section('section')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="container mx-auto px-4 sm:px-6 py-6 sm:py-8">
            <!-- Header Section -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Kelola Transaksi</h1>
                        <p class="text-gray-600 text-sm sm:text-base">Pantau dan kelola semua transaksi pembayaran</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                        <div class="bg-white rounded-lg px-4 py-2 shadow-sm border text-center sm:text-left">
                            <span class="text-sm text-gray-500">Total Transaksi</span>
                            <div class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $transactions ? $transactions->count() : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($error))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ $error }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filter Status Cards -->
            <div class="bg-white rounded-xl shadow-sm mb-6 p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Status</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                    <a href="{{ route('admin.transactions.index') }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ !request('status') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Semua</div>
                                <div class="text-lg sm:text-xl font-bold">{{ $transactions ? $transactions->count() : 0 }}
                                </div>
                            </div>
                            <div class="text-2xl opacity-75">📊</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'pending']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'pending' ? 'bg-gradient-to-br from-yellow-400 to-orange-500 text-white shadow-lg' : 'bg-gray-50 hover:bg-yellow-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Pending</div>
                                <div class="text-lg sm:text-xl font-bold">
                                    {{ $transactions ? $transactions->where('status', 'pending')->count() : 0 }}</div>
                            </div>
                            <div class="text-2xl opacity-75">⏳</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'approved']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'approved' ? 'bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg' : 'bg-gray-50 hover:bg-green-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Approved</div>
                                <div class="text-lg sm:text-xl font-bold">
                                    {{ $transactions ? $transactions->where('status', 'approved')->count() : 0 }}</div>
                            </div>
                            <div class="text-2xl opacity-75">✅</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'rejected']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'rejected' ? 'bg-gradient-to-br from-red-500 to-pink-600 text-white shadow-lg' : 'bg-gray-50 hover:bg-red-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Rejected</div>
                                <div class="text-lg sm:text-xl font-bold">
                                    {{ $transactions ? $transactions->where('status', 'rejected')->count() : 0 }}</div>
                            </div>
                            <div class="text-2xl opacity-75">❌</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Frame
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Bukti Bayar
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($transactions && $transactions->count() > 0)
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-mono text-sm">{{ $transaction->order_id ?? 'N/A' }}</span>
                                                @if ($transaction->status == 'approved' && isset($transaction->frame_id))
                                                    <a href="{{ route('booth', ['frame_id' => $transaction->frame_id, 'order_id' => $transaction->order_id]) }}"
                                                        target="_blank"
                                                        class="text-blue-600 hover:text-blue-900 text-xs mt-1 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                            </path>
                                                        </svg>
                                                        Lihat Link
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center">
                                                    <span class="text-xs">🖼️</span>
                                                </div>
                                                <span>{{ $transaction->frame ? $transaction->frame->name : 'Frame Deleted' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $transaction->email ?: 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            @if (method_exists($transaction, 'getFormattedAmountAttribute'))
                                                {{ $transaction->formatted_amount }}
                                            @else
                                                Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($transaction->status == 'pending')
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    ⏳ Pending
                                                </span>
                                            @elseif($transaction->status == 'approved')
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    ✅ Approved
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    ❌ Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if ($transaction->payment_proof)
                                                <button onclick="viewPaymentProof('{{ $transaction->payment_proof }}')"
                                                    class="text-blue-600 hover:text-blue-900 flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Lihat Bukti
                                                </button>
                                            @else
                                                <span class="text-gray-400">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($transaction->status == 'pending')
                                                <div class="flex gap-2">
                                                    <button onclick="approveTransaction({{ $transaction->id }})"
                                                        class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-lg text-xs font-medium transition-colors duration-200">
                                                        ✅ Approve
                                                    </button>
                                                    <button onclick="rejectTransaction({{ $transaction->id }})"
                                                        class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-medium transition-colors duration-200">
                                                        ❌ Reject
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-4">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada transaksi</h3>
                                                <p class="text-gray-500">Transaksi akan muncul di sini setelah ada
                                                    pembayaran</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-4">
                @if ($transactions && $transactions->count() > 0)
                    @foreach ($transactions as $transaction)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <!-- Card Header -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-3 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center">
                                            <span class="text-xs">🖼️</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 text-sm">
                                                {{ $transaction->frame ? $transaction->frame->name : 'Frame Deleted' }}
                                            </h3>
                                            <p class="text-xs text-gray-500 font-mono">
                                                {{ $transaction->order_id ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    @if ($transaction->status == 'pending')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            ⏳ Pending
                                        </span>
                                    @elseif($transaction->status == 'approved')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            ✅ Approved
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            ❌ Rejected
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-4 space-y-3">
                                <div class="flex justify-between items-center ">
                                    <div>
                                        <span
                                            class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</span>
                                        <p class="text-sm text-gray-900 mt-1">{{ $transaction->email ?: 'Tidak ada' }}</p>
                                    </div>
                                    <div>
                                        <span
                                            class="text-xs font-medium text-gray-500 uppercase tracking-wide">Amount</span>
                                        <p class="text-sm font-semibold text-gray-900 mt-1">
                                            @if (method_exists($transaction, 'getFormattedAmountAttribute'))
                                                {{ $transaction->formatted_amount }}
                                            @else
                                                Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if ($transaction->status == 'approved' && isset($transaction->frame_id))
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <a href="{{ route('booth', ['frame_id' => $transaction->frame_id, 'order_id' => $transaction->order_id]) }}"
                                            target="_blank"
                                            class="text-blue-600 hover:text-blue-900 text-sm font-medium flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            Buka Link Booth
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Actions -->
                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                                <div class="flex justify-between items-center gap-3">
                                    <div class="flex-1">
                                        @if ($transaction->payment_proof)
                                            <button onclick="viewPaymentProof('{{ $transaction->payment_proof }}')"
                                                class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-3 rounded-lg text-sm transition-colors duration-200 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat Bukti
                                            </button>
                                        @else
                                            <div
                                                class="w-full bg-gray-100 text-gray-400 font-medium py-2 px-3 rounded-lg text-sm text-center">
                                                Tidak ada bukti
                                            </div>
                                        @endif
                                    </div>
                                    @if ($transaction->status == 'pending')
                                        <div class="flex gap-2">
                                            <button onclick="approveTransaction({{ $transaction->id }})"
                                                class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                                ✅
                                            </button>
                                            <button onclick="rejectTransaction({{ $transaction->id }})"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                                ❌
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada transaksi</h3>
                        <p class="text-gray-500">Transaksi akan muncul di sini setelah ada pembayaran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Proof Modal -->
    <div id="paymentProofModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-full overflow-hidden">
            <div class="flex justify-between items-center p-4 sm:p-6 border-b border-gray-200">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Bukti Pembayaran</h3>
                <button onclick="closePaymentProofModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 sm:p-6 max-h-96 overflow-auto">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran"
                    class="w-full h-auto rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <script>
        function viewPaymentProof(imagePath) {
            document.getElementById('paymentProofImage').src = '/storage/' + imagePath;
            document.getElementById('paymentProofModal').classList.remove('hidden');
            document.getElementById('paymentProofModal').classList.add('flex');
        }

        function closePaymentProofModal() {
            document.getElementById('paymentProofModal').classList.add('hidden');
            document.getElementById('paymentProofModal').classList.remove('flex');
        }

        async function approveTransaction(transactionId) {
            if (!confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')) return;

            try {
                const response = await fetch(`/admin/transactions/${transactionId}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Show success notification
                    showNotification('Transaksi berhasil disetujui!', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification('Error: ' + result.message, 'error');
                }
            } catch (error) {
                showNotification('Terjadi kesalahan: ' + error.message, 'error');
            }
        }

        async function rejectTransaction(transactionId) {
            if (!confirm('Apakah Anda yakin ingin menolak transaksi ini?')) return;

            try {
                const response = await fetch(`/admin/transactions/${transactionId}/reject`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showNotification('Transaksi berhasil ditolak!', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification('Error: ' + result.message, 'error');
                }
            } catch (error) {
                showNotification('Terjadi kesalahan: ' + error.message, 'error');
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('paymentProofModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentProofModal();
            }
        });
    </script>
@endsection
