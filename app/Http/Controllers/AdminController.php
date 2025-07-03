<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Transaction;
use App\Models\Frame;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('admin_id')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            Session::put('admin_email', $admin->email);
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Session::forget(['admin_id', 'admin_name', 'admin_email']);
        return redirect('/admin/login');
    }

    public static function checkAdminLogin()
    {
        return Session::has('admin_id');
    }

    public function transactions(Request $request)
    {
        try {
            // Base query for filtered transactions
            $query = Transaction::with('frame');

            // Filter by status
            if ($request->has('status') && $request->status !== 'all' && $request->status !== null) {
                $query->where('status', $request->status);
            }

            $transactions = $query->orderBy('created_at', 'desc')->get();

            // Calculate counts for all statuses independently
            $counts = [
                'total' => Transaction::count(),
                'pending' => Transaction::where('status', 'pending')->count(),
                'approved' => Transaction::where('status', 'approved')->count(),
                'rejected' => Transaction::where('status', 'rejected')->count(),
            ];

            return view('admin.transactions.index', compact('transactions', 'counts'));
        } catch (\Exception $e) {
            Log::error('Error in transactions method: ' . $e->getMessage());
            $transactions = collect();
            $counts = [
                'total' => 0,
                'pending' => 0,
                'approved' => 0,
                'rejected' => 0,
            ];
            return view('admin.transactions.index', compact('transactions', 'counts'))
                ->with('error', 'An error occurred');
        }
    }

    public function approveTransaction($id)
    {
        try {
            $transaction = Transaction::with('frame')->findOrFail($id);

            if ($transaction->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi ini sudah diproses sebelumnya.'
                ], 400);
            }

            // Update status transaksi
            $transaction->update([
                'status' => 'approved',
                'approved_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disetujui.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error approving transaction: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses transaksi.'
            ], 500);
        }
    }


    public function rejectTransaction($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);

            if ($transaction->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi ini sudah diproses sebelumnya.'
                ], 400);
            }

            $transaction->update(['status' => 'rejected']);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil ditolak.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error rejecting transaction: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses transaksi.'
            ], 500);
        }
    }

    public function checkPaymentStatus($orderId)
    {
        try {
            $transaction = Transaction::where('order_id', $orderId)->firstOrFail();
            return response()->json([
                'success' => true,
                'status' => $transaction->status
            ]);
        } catch (\Exception $e) {
            Log::error('Error checking payment status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan.'
            ], 404);
        }
    }

    // Tambahkan method ini ke AdminController atau DashboardController Anda

    public function dashboard()
    {
        try {
            // Statistik Transaksi
            $transactionStats = [
                'total' => Transaction::count(),
                'pending' => Transaction::where('status', 'pending')->count(),
                'approved' => Transaction::where('status', 'approved')->count(),
                'rejected' => Transaction::where('status', 'rejected')->count(),
                'today' => Transaction::whereDate('created_at', today())->count(),
                'last_24h' => Transaction::where('created_at', '>=', now()->subDay())->count(),
            ];

            // Transaksi 24 jam terakhir
            $recentTransactions = Transaction::with('frame')
                ->where('created_at', '>=', now()->subDay())
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Transaksi pending (belum di-approve)
            $pendingTransactions = Transaction::with('frame')
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Statistik Testimoni
            $testimoniStats = [
                'total' => Testimoni::count(),
                'today' => Testimoni::whereDate('created_at', today())->count(),
                'last_24h' => Testimoni::where('created_at', '>=', now()->subDay())->count(),
                'average_rating' => round(Testimoni::avg('rating'), 1),
                'by_rating' => [
                    5 => Testimoni::where('rating', 5)->count(),
                    4 => Testimoni::where('rating', 4)->count(),
                    3 => Testimoni::where('rating', 3)->count(),
                    2 => Testimoni::where('rating', 2)->count(),
                    1 => Testimoni::where('rating', 1)->count(),
                ]
            ];

            // Testimoni terbaru
            $recentTestimoni = Testimoni::orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Revenue stats (jika ada kolom amount di transaksi)
            $revenueStats = [
                'today' => Transaction::where('status', 'approved')
                    ->whereDate('created_at', today())
                    ->sum('amount'),
                'this_month' => Transaction::where('status', 'approved')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('amount'),
                'total' => Transaction::where('status', 'approved')->sum('amount'),
            ];

            return view('admin.dashboard', compact(
                'transactionStats',
                'recentTransactions',
                'pendingTransactions',
                'testimoniStats',
                'recentTestimoni',
                'revenueStats'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());

            // Return dengan data kosong jika error
            return view('admin.dashboard', [
                'transactionStats' => ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0, 'today' => 0, 'last_24h' => 0],
                'recentTransactions' => collect(),
                'pendingTransactions' => collect(),
                'testimoniStats' => ['total' => 0, 'today' => 0, 'last_24h' => 0, 'average_rating' => 0, 'by_rating' => []],
                'recentTestimoni' => collect(),
                'revenueStats' => ['today' => 0, 'this_month' => 0, 'total' => 0]
            ])->with('error', 'Terjadi kesalahan saat memuat dashboard.');
        }
    }
}
