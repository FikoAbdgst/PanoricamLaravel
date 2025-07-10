<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'frame_id',
        'customer_name',
        'whatsapp_number',
        'payment_method',
        'amount',
        'payment_proof',
        'status',
        'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime'
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedWhatsappAttribute()
    {
        // Handle NULL values
        if (empty($this->whatsapp_number)) {
            return null;
        }

        // Format WhatsApp number for display
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp_number);
        if (substr($number, 0, 1) == '0') {
            $number = '62' . substr($number, 1);
        }
        return $number;
    }

    public function hasWhatsapp()
    {
        return !empty($this->whatsapp_number);
    }
}
