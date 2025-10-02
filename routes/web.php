
<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FrameController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\FrameTempController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotoboothController;

// routes/web.php
Route::get('/', [HomeController::class, 'index'])->name('home');

// Add these routes to your routes/web.php file

Route::get('/get-frame-template/{frame_id}', [HomeController::class, 'getFrameTemplate'])->name('getFrameTemplate');
Route::post('/save-frame-photos', [HomeController::class, 'saveFramePhotos'])->name('saveFramePhotos');
Route::get('/get-frame-status/{frame_id}', [HomeController::class, 'getFrameStatus'])->name('getFrameStatus');

Route::post('/savePhoto', [PhotoboothController::class, 'savePhoto'])->name('savePhoto');
// Rute autentikasi admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Rute admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        // Redirect ke login jika belum login
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Rute CRUD frame
    Route::get('/frames', [FrameController::class, 'index'])->name('frames.index');
    Route::get('/frames/create', [FrameController::class, 'create'])->name('frames.create');
    Route::post('/frames', [FrameController::class, 'store'])->name('frames.store');
    Route::get('/frames/{frame}', [FrameController::class, 'show'])->name('frames.show');
    Route::get('/frames/{frame}/edit', [FrameController::class, 'edit'])->name('frames.edit');
    Route::put('/frames/{frame}', [FrameController::class, 'update'])->name('frames.update');
    Route::delete('/frames/{frame}', [FrameController::class, 'destroy'])->name('frames.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [AdminController::class, 'transactions'])->name('index');
        Route::post('/{id}/approve', [AdminController::class, 'approveTransaction'])->name('approve');
        Route::post('/{id}/reject', [AdminController::class, 'rejectTransaction'])->name('reject');
        Route::get('/check-status/{orderId}', [AdminController::class, 'checkPaymentStatus'])->name('check-status');
    });

    // Testimoni routes (jika belum ada)
    Route::prefix('testimoni')->name('testimoni.')->group(function () {
        Route::get('/', [TestimoniController::class, 'index'])->name('index');
        Route::patch('/{id}/toggle', [TestimoniController::class, 'toggle'])->name('toggle');
        Route::delete('/{id}', [TestimoniController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [TestimoniController::class, 'bulkDelete'])->name('bulk-delete');
        Route::get('/export', [TestimoniController::class, 'export'])->name('export');
        Route::get('/stats', [TestimoniController::class, 'getStats'])->name('stats');
    });
});

Route::get('/maintenance', function () {
    return view('maintenance'); // Pastikan view 'maintenance.blade.php' ada
})->name('maintenance');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/frame', [FrameTempController::class, 'index'])->name('frametemp');
Route::get('/booth', [PhotoboothController::class, 'index'])->name('booth');
Route::post('/save-photo', [PhotoboothController::class, 'savePhoto'])->name('savePhoto');
Route::post('/booth/reset-used', [PhotoboothController::class, 'resetUsedStatus']);




// Payment routes
Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::post('/upload-to-drive', [DriveController::class, 'uploadToDrive']);


Route::post('/submitTestimoni', [PhotoBoothController::class, 'submitTestimoni'])->name('testimoni.submit');
Route::get('/api/testimonis', [HomeController::class, 'getTestimonis']);
Route::get('/api/testimoni-stats', [HomeController::class, 'getTestimoniStats']);

Route::get('/check-payment-status/{orderId}', [AdminController::class, 'checkPaymentStatus'])->name('payment.status');

Route::fallback(function () {
    return "halaman tidak ada";
});
