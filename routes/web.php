<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\PublicMagicLabController;
use App\Http\Controllers\PublicJournalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\JournalController as AdminJournalController;

// Halaman Publik
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/portfolio', [PublicPortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/magic-lab', [PublicMagicLabController::class, 'index'])->name('magic_lab.index');
Route::get('/journal', [PublicJournalController::class, 'index'])->name('journal.index');
Route::get('/journal/{slug}', [PublicJournalController::class, 'show'])->name('journal.show');

// Route Auth (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Login KHUSUS ADMIN — URL terpisah agar tidak bisa ditebak
    Route::get('/admin-akses', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin-akses', [AuthController::class, 'adminLogin']);
});

// Rute Umum yang Butuh Login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profil (Bisa diakses Admin maupun User)
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Rute khusus User Biasa
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // ⚠️ Route spesifik HARUS di atas route wildcard {booking}
    Route::delete('/booking/message/{message}', [BookingController::class, 'deleteMessage'])->name('booking.chat.delete');

    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{booking}/chat', [BookingController::class, 'storeMessage'])->name('booking.chat');
    
    // Payment routes
    Route::post('/booking/{booking}/pay', [PaymentController::class, 'initiatePayment'])->name('booking.pay');
    Route::get('/booking/{booking}/payment-finish', [PaymentController::class, 'paymentFinish'])->name('payment.finish');
    Route::get('/booking/{booking}/payment-success', [PaymentController::class, 'paymentSuccessPage'])->name('payment.success.page');
    Route::post('/booking/{booking}/reset-token', [PaymentController::class, 'resetToken'])->name('booking.resetToken');
    Route::post('/booking/{booking}/payment-success', [PaymentController::class, 'paymentSuccess'])->name('booking.paymentSuccess');
    Route::post('/booking/{booking}/payment-pending', [PaymentController::class, 'paymentPending'])->name('booking.paymentPending');
    Route::post('/booking/{booking}/request-refund', [PaymentController::class, 'requestRefund'])->name('booking.requestRefund');
    
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

// Midtrans Payment Webhook & Callbacks (tanpa auth, karena midtrans mengakses ini)
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');
Route::get('/payment/finish', function() { return view('payment.finish'); })->name('payment.finish');
Route::get('/payment/unfinish', function() { return view('payment.unfinish'); })->name('payment.unfinish');
Route::get('/payment/error', function() { return view('payment.error'); })->name('payment.error');

// Rute khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    
    // Admin Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');

    // ⚠️ Route spesifik HARUS di atas route wildcard {booking}
    Route::delete('/bookings/message/{message}', [AdminBookingController::class, 'deleteMessage'])->name('bookings.chat.delete');

    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/chat', [AdminBookingController::class, 'storeMessage'])->name('bookings.chat');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::patch('/bookings/{booking}/payment', [AdminBookingController::class, 'verifyPayment'])->name('bookings.verifyPayment');
    Route::patch('/bookings/{booking}/price', [AdminBookingController::class, 'updatePrice'])->name('bookings.updatePrice');
    Route::patch('/bookings/{booking}/refund', [AdminBookingController::class, 'updateRefund'])->name('bookings.updateRefund');

    // Admin Portfolios & Profile
    Route::patch('/portfolios/profile', [AdminPortfolioController::class, 'updateProfile'])->name('portfolios.updateProfile');
    Route::resource('portfolios', AdminPortfolioController::class)->except(['create', 'show', 'edit']);

    // Admin Magic Lab (Categories)
    Route::resource('categories', AdminCategoryController::class)->except(['create', 'show', 'edit']);

    // Admin Journals
    Route::resource('journals', AdminJournalController::class)->except(['create', 'show', 'edit']);
});
