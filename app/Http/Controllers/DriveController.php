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
                    ->subject('🎉 Kenangan Indah Anda Siap Disimpan! - PanoriCam')
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
╔══════════════════════════════════════════╗
║   🎊 KENANGAN INDAH ANDA TELAH SIAP! 🎊   ║
╚══════════════════════════════════════════╝

Hai!

Yeay! Momen spesial Anda telah berhasil kami proses dengan sempurna!
Foto berkualitas tinggi dan GIF animasi Anda sudah siap untuk disimpan
dan dibagikan kepada orang-orang terkasih. ✨


📦 YANG ANDA DAPATKAN:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📸 Panoricam💫.png
   → Foto strip berkualitas HD siap cetak
   → Format PNG dengan resolusi terbaik
   → Sempurna untuk kenang-kenangan fisik maupun digital

🎬 PanoricamGif✨.gif
   → Animasi bergerak dari rangkaian momen Anda
   → Langsung bisa dibagikan di media sosial
   → Bikin feed Instagram & WhatsApp Story makin menarik!


💡 CARA PAKAI HASIL FOTO ANDA:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

✓ Download kedua file dari lampiran email ini
✓ Simpan di galeri atau cloud storage favorit Anda
✓ Share langsung ke Instagram, TikTok, Facebook, atau WhatsApp
✓ Cetak foto PNG untuk dipajang atau dijadikan hadiah
✓ Jadikan wallpaper HP untuk mengingat momen indah ini


🌟 REKOMENDASI DARI KAMI:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

• Cetak foto untuk hasil maksimal dengan kualitas premium
• Upload GIF ke Instagram Story dengan musik favorit
• Kirim ke keluarga & teman sebagai kejutan manis
• Backup file ke Google Drive atau iCloud
• Tag kami saat share di social media! 📱


Terima kasih sudah mempercayai PanoriCam untuk mengabadikan
momen berharga Anda. Kami senang bisa menjadi bagian dari
kenangan indah Anda! 💖

Sampai jumpa di momen spesial berikutnya!


Dengan cinta,
Tim PanoriCam 📷✨


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Email ini dikirim otomatis. Mohon tidak membalas.
Butuh bantuan? Hubungi kami di [website/support]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
        ";
    }
}
