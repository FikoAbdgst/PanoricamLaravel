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
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ !request('status') ? 'bg-gradient-to-br from-blue-400 to-purple-300 text-white shadow-lg' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Semua</div>
                                <div class="text-lg sm:text-xl font-bold">{{ $counts['total'] }}</div>
                            </div>
                            <div class="text-2xl opacity-75">📊</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'pending']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'pending' ? 'bg-gradient-to-br from-yellow-400 to-orange-300 text-white shadow-lg' : 'bg-gray-50 hover:bg-yellow-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Pending</div>
                                <div class="text-lg sm:text-xl font-bold">{{ $counts['pending'] }}</div>
                            </div>
                            <div class="text-2xl opacity-75">⏳</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'approved']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'approved' ? 'bg-gradient-to-br from-green-400 to-emerald-300 text-white shadow-lg' : 'bg-gray-50 hover:bg-green-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Approved</div>
                                <div class="text-lg sm:text-xl font-bold">{{ $counts['approved'] }}</div>
                            </div>
                            <div class="text-2xl opacity-75">✅</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.transactions.index', ['status' => 'rejected']) }}"
                        class="group relative overflow-hidden rounded-xl p-4 transition-all duration-300 hover:shadow-lg {{ request('status') == 'rejected' ? 'bg-gradient-to-br from-red-400 to-pink-300 text-white shadow-lg' : 'bg-gray-50 hover:bg-red-50 text-gray-700' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs sm:text-sm font-medium opacity-90 mb-1">Rejected</div>
                                <div class="text-lg sm:text-xl font-bold">{{ $counts['rejected'] }}</div>
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
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Customer
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Frame
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Method
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($transactions && $transactions->count() > 0)
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <span class="font-mono text-sm font-medium text-gray-900">
                                                    {{ $transaction->order_id ?? 'N/A' }}
                                                </span>
                                                <span class="text-xs text-gray-500">
                                                    {{ $transaction->created_at->format('d M Y, H:i') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium text-gray-900">
                                                    {{ $transaction->customer_name ?? 'N/A' }}
                                                </span>
                                                @if ($transaction->whatsapp_number)
                                                    <span class="text-xs text-gray-500">
                                                        {{ $transaction->whatsapp_number }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center">
                                                    <span class="text-xs">🖼️</span>
                                                </div>
                                                <span class="text-sm text-gray-900">
                                                    {{ $transaction->frame ? $transaction->frame->name : 'Frame Deleted' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-gray-900">
                                                @if (method_exists($transaction, 'getFormattedAmountAttribute'))
                                                    {{ $transaction->formatted_amount }}
                                                @else
                                                    Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $transaction->payment_method == 'bank_transfer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                                {{ $transaction->payment_method == 'bank_transfer' ? 'E-Wallet' : 'QRIS' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
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
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    ❌ Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="viewTransactionDetail({{ $transaction->id }})"
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    Detail
                                                </button>
                                                @if ($transaction->status == 'pending')
                                                    <button onclick="approveTransaction({{ $transaction->id }})"
                                                        class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                        Approve
                                                    </button>
                                                    <button onclick="rejectTransaction({{ $transaction->id }})"
                                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                        Reject
                                                    </button>
                                                @endif
                                            </div>
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
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center">
                                            <span class="text-sm">🖼️</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 text-sm">
                                                {{ $transaction->customer_name ?? 'N/A' }}</h3>
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

                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Frame:</span>
                                        <span
                                            class="font-medium">{{ $transaction->frame ? $transaction->frame->name : 'Deleted' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Amount:</span>
                                        <span class="font-semibold">
                                            @if (method_exists($transaction, 'getFormattedAmountAttribute'))
                                                {{ $transaction->formatted_amount }}
                                            @else
                                                Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Method:</span>
                                        <span
                                            class="text-xs px-2 py-1 rounded-full {{ $transaction->payment_method == 'bank_transfer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ $transaction->payment_method == 'bank_transfer' ? 'E-Wallet' : 'QRIS' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Date:</span>
                                        <span>{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                                <div class="flex justify-between items-center gap-2">
                                    <button onclick="viewTransactionDetail({{ $transaction->id }})"
                                        class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-3 rounded-lg text-sm transition-colors">
                                        Detail
                                    </button>
                                    @if ($transaction->status == 'pending')
                                        <button onclick="approveTransaction({{ $transaction->id }})"
                                            class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-sm font-medium">
                                            ✅
                                        </button>
                                        <button onclick="rejectTransaction({{ $transaction->id }})"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg text-sm font-medium">
                                            ❌
                                        </button>
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
    <div id="paymentProofModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-[60]">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Bukti Pembayaran</h3>
                <button onclick="closePaymentProofModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-auto max-h-[70vh] flex items-center justify-center">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran"
                    class="max-w-full h-auto rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <!-- Transaction Details Modal -->
    <div id="transactionDetailModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">Detail Transaksi</h3>
                <button onclick="closeTransactionDetailModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-180px)]">
                <div id="transactionDetailContent" class="space-y-6">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 bg-gray-50">
                <div id="transactionDetailActions" class="flex justify-end gap-3">
                    <!-- Actions will be loaded here -->
                </div>
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

        function viewTransactionDetail(transactionId) {
            const transaction = @json($transactions->keyBy('id'));
            const transactionData = transaction[transactionId];

            if (!transactionData) {
                showNotification('Data transaksi tidak ditemukan', 'error');
                return;
            }

            // Build detail content with improved styling
            const detailContent = `
                <div class="bg-white rounded-lg">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Transaction Info -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Informasi Transaksi
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Order ID:</span>
                                        <span class="text-sm font-mono bg-white px-2 py-1 rounded">${transactionData.order_id || 'N/A'}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Status:</span>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(transactionData.status)}">
                                            ${getStatusText(transactionData.status)}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Amount:</span>
                                        <span class="text-sm font-bold text-green-600">Rp ${Number(transactionData.amount || 0).toLocaleString('id-ID')}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Payment Method:</span>
                                        <span class="text-sm px-2 py-1 rounded-full ${transactionData.payment_method === 'bank_transfer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'}">
                                            ${transactionData.payment_method === 'bank_transfer' ? 'E-Wallet' : 'QRIS'}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-sm font-medium text-gray-600">Created:</span>
                                        <span class="text-sm text-gray-700">${formatDate(transactionData.created_at)}</span>
                                    </div>
                                    ${transactionData.approved_at ? `
                                                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                                                            <span class="text-sm font-medium text-gray-600">Approved:</span>
                                                            <span class="text-sm text-gray-700">${formatDate(transactionData.approved_at)}</span>
                                                        </div>
                                                    ` : ''}
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Customer Info -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informasi Customer
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Name:</span>
                                        <span class="text-sm font-medium text-gray-900">${transactionData.customer_name || 'N/A'}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">WhatsApp:</span>
                                        <span class="text-sm text-gray-700">${transactionData.whatsapp_number || 'Not provided'}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-sm font-medium text-gray-600">Frame:</span>
                                        <span class="text-sm text-gray-700">${transactionData.frame ? transactionData.frame.name : 'Frame Deleted'}</span>
                                    </div>
                                </div>
                            </div>

                            ${transactionData.status === 'approved' && transactionData.frame_id ? `
                                                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                                                    <h4 class="font-semibold text-blue-900 mb-2 flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                        </svg>
                                                        Booth Access
                                                    </h4>
                                                    <a href="/booth/${transactionData.frame_id}/${transactionData.order_id}" 
                                                       target="_blank" 
                                                       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm hover:underline">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                        </svg>
                                                        Open Booth Link
                                                    </a>
                                                </div>
                                            ` : ''}
                        </div>
                    </div>

                    ${transactionData.payment_proof ? `
                                        <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                                            <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                Bukti Pembayaran
                                            </h4>
                                            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                                                <img src="/storage/${transactionData.payment_proof}" 
                                                     alt="Payment Proof" 
                                                     class="max-w-full h-auto max-h-60 mx-auto rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow border border-gray-200"
                                                     onclick="viewPaymentProof('${transactionData.payment_proof}')">
                                                <p class="text-sm text-gray-500 mt-2">Klik gambar untuk memperbesar</p>
                                            </div>
                                        </div>
                                    ` : ''}
                </div>
            `;

            // Build actions with improved styling
            const actions = transactionData.status === 'pending' ? `
                <button onclick="rejectTransaction(${transactionData.id})" 
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reject
                </button>
                <button onclick="approveTransaction(${transactionData.id})" 
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Approve
                </button>
            ` : `
                <button onclick="closeTransactionDetailModal()" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                    Close
                </button>
            `;

            document.getElementById('transactionDetailContent').innerHTML = detailContent;
            document.getElementById('transactionDetailActions').innerHTML = actions;
            document.getElementById('transactionDetailModal').classList.remove('hidden');
            document.getElementById('transactionDetailModal').classList.add('flex');
        }

        function closeTransactionDetailModal() {
            document.getElementById('transactionDetailModal').classList.add('hidden');
            document.getElementById('transactionDetailModal').classList.remove('flex');
        }

        function getStatusBadgeClass(status) {
            switch (status) {
                case 'pending':
                    return 'bg-yellow-100 text-yellow-800';
                case 'approved':
                    return 'bg-green-100 text-green-800';
                case 'rejected':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'pending':
                    return '⏳ Pending';
                case 'approved':
                    return '✅ Approved';
                case 'rejected':
                    return '❌ Rejected';
                default:
                    return status;
            }
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Close modal when clicking outside
        document.getElementById('transactionDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTransactionDetailModal();
            }
        });

        document.getElementById('paymentProofModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentProofModal();
            }
        });

        // Enhanced notification function
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${type === 'success' 
                            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
                            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Animate out
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
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
                    showNotification('Transaksi berhasil disetujui!', 'success');
                    closeTransactionDetailModal();
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
                    closeTransactionDetailModal();
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

        // Close modals when clicking outside
        document.getElementById('paymentProofModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentProofModal();
            }
        });

        document.getElementById('transactionDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTransactionDetailsModal();
            }
        });
    </script>
@endsection
