<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        try {
            $request->validate([
                'frame_id' => 'required|exists:frames,id',
                'customer_name' => 'required|string|max:255',
                'whatsapp_number' => 'nullable|numeric', // Changed to nullable
                'payment_method' => 'required|in:bank_transfer,qris',
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $frame = Frame::findOrFail($request->frame_id);

            // Generate unique order ID
            do {
                $orderId = 'ORD' . date('Ymd') . strtoupper(Str::random(6));
            } while (Transaction::where('order_id', $orderId)->exists());

            // Upload payment proof
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            // Create transaction
            $transaction = Transaction::create([
                'order_id' => $orderId,
                'frame_id' => $frame->id,
                'customer_name' => $request->customer_name,
                'whatsapp_number' => $request->whatsapp_number, // Will be null if not provided
                'payment_method' => $request->payment_method,
                'amount' => $frame->price,
                'payment_proof' => $paymentProofPath,
                'status' => 'pending'
            ]);

            // Get payment method name for response
            $paymentMethodName = $request->payment_method == 'bank_transfer' ? 'E-Wallet' : 'QRIS';

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil disubmit melalui ' . $paymentMethodName . '. Menunggu konfirmasi admin.',
                'order_id' => $orderId,
                'payment_method' => $paymentMethodName,
                'customer_name' => $request->customer_name
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->errors()[array_key_first($e->errors())])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approvePayment($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $transaction->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran telah disetujui'
        ]);
    }

    public function rejectPayment($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $transaction->update(['status' => 'rejected']);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran telah ditolak'
        ]);
    }
}
