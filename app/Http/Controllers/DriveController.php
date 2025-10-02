<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DriveController extends Controller
{
    public function uploadToDrive(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required|file|mimes:png,jpg,jpeg|max:10240',
                'gif' => 'required|file|mimes:gif|max:10240',
                'email' => 'required|email',
                'frame_id' => 'required'
            ]);

            $email = $request->email;
            $photoFile = $request->file('photo');
            $gifFile = $request->file('gif');

            // Kirim email dengan kedua attachment
            Mail::send([], [], function ($message) use ($email, $photoFile, $gifFile) {
                $message->to($email)
                    ->subject('✨ Foto Strip & GIF Anda Sudah Siap! - PanoriCam')
                    ->text($this->getEmailTemplateText())
                    ->attach($photoFile->getRealPath(), [
                        'as' => 'Panoricam💫.png',
                        'mime' => 'image/png',
                    ])
                    ->attach($gifFile->getRealPath(), [
                        'as' => 'PanoricamGif✨.gif',
                        'mime' => 'image/gif',
                    ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Foto HD dan GIF animasi berhasil dikirim ke email ' . $email
            ]);
        } catch (\Exception $e) {
            Log::error('Email send error: ' . $e->getMessage());

            $errorMessage = 'Gagal mengirim email: ';

            if (str_contains($e->getMessage(), 'SMTP') || str_contains($e->getMessage(), 'authenticate')) {
                $errorMessage .= 'Masalah konfigurasi email server. Silakan hubungi admin.';
            } else {
                $errorMessage .= $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 500);
        }
    }

    private function getEmailTemplateText()
    {
        return "
========================================
FOTO & GIF ANDA SUDAH SIAP!
========================================

Halo!

Terima kasih telah menggunakan PanoriCam! Foto strip HD dan GIF animasi Anda telah berhasil dibuat dan dilampirkan dalam email ini.


FILE TERLAMPIR:
----------------------------------------
1. Panoricam💫.png
   Foto strip berkualitas tinggi dalam format PNG
   Cocok untuk dicetak atau dibagikan di media sosial

2. PanoricamGif✨.gif
   GIF animasi dari rangkaian foto Anda
   Siap untuk dibagikan langsung di platform digital


CARA MENGGUNAKAN FILE:
----------------------------------------
• Unduh kedua file dari lampiran email ini
• Simpan sebagai kenang-kenangan digital Anda
• Bagikan momen spesial Anda di Instagram, Facebook, atau WhatsApp
• Cetak foto PNG untuk hasil terbaik secara fisik


TIPS:
----------------------------------------
• File PNG memiliki kualitas terbaik untuk pencetakan
• GIF dapat langsung diupload ke story atau feed media sosial
• Simpan file di cloud storage agar tidak hilang


Kami harap Anda menikmati hasil foto Anda!

Salam hangat,
Tim PanoriCam


========================================
Email otomatis - Mohon tidak membalas
Butuh bantuan? Kunjungi: [website/support]
========================================
        ";
    }
}
