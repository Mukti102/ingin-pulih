<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsichologServiceController;
use App\Http\Controllers\PsychologController;
use App\Http\Controllers\PsychologistWeeklyScheduleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionMeetController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;



// --- PUBLIC ROUTES ---
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/cari-psikolog', [GuestController::class, 'listPsychologs'])->name('list.psychologs');
Route::get('/artikel', [GuestController::class, 'articles'])->name('articles');
Route::get('/artikel/{slug}', [GuestController::class, 'showArticle'])->name('showArticle');
Route::get('/cari-psikolog/{id}', [GuestController::class, 'detailPsikolog'])->name('detail.psikolog');

// callback route untuk payment gateway
Route::post('/payment/callback', [TransactionController::class, 'notification'])->name('midtrans.notification');
Route::get('/payment/success/{code}', [TransactionController::class, 'success'])->name('booking.success');


// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {


    // 1. ROUTE KHUSUS ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('jenis-psikolog', TypeController::class);
        Route::resource('topik-keahlian', TopicController::class);
        Route::resource('wilayah-praktik', WilayahController::class);
        Route::resource('users', UserController::class);
        Route::resource('psychologs', PsychologController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('articles', ArticleController::class);

        // Payout Management (Hanya Admin yang bisa Approve/Reject)
        Route::patch('/payouts/{id}/approve', [PayoutController::class, 'approve'])->name('payouts.approve');
        Route::patch('/payouts/{id}/reject', [PayoutController::class, 'reject'])->name('payouts.reject');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');
        });
    });

    // 2. ROUTE KHUSUS PSIKOLOG
    Route::middleware('role:psycholog')->group(function () {
        Route::get('/dashboard/psycholog', [DashboardController::class, 'dashboardPsikolog'])->name('dashboard.psycholog');
        Route::resource('psycholog-services', PsichologServiceController::class);
        Route::resource('psycholog-weekly-schedules', PsychologistWeeklyScheduleController::class);

        // Transaksi & Wallet Psikolog
        Route::post('/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw');
        Route::post('/bank_account', [TransactionController::class, 'updateBankAccount'])->name('bank_account.update');

        Route::get('/toggle/reviews/{id}', [ReviewController::class, 'togglePublish'])->name('reviews.toggle-publish');

        // Session & Room Management
        Route::patch('/room-create/{id}', [SessionMeetController::class, 'createRoom'])->name('session.create.room');
        Route::patch('/create-note/{id}', [SessionMeetController::class, 'storeNote'])->name('create.note');
    });

    // 3. ROUTE KHUSUS CLIENT / USER BIASA
    Route::middleware('role:user')->group(function () {
        Route::get('client/dashboard', [clientController::class, 'index'])->name('client.dashboard');
        Route::get('client/sessions', [clientController::class, 'sessions'])->name('client.sessions');
        Route::get('client/sessions/{code}', [clientController::class, 'SessionShow'])->name('client.sessions.show');
        Route::get('client/history', [clientController::class, 'history'])->name('client.history');
        Route::get('/bookings/checkout/{code}', [TransactionController::class, 'checkoutPage'])->name('bookings.checkout');
    });

    // 4. ROUTE CAMPURAN / SHARED (Bisa diakses semua Role asal Auth)
    Route::resource('reviews', ReviewController::class);
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/payouts/{id}', [PayoutController::class, 'show'])->name('payouts.show');
    Route::delete('/payouts/{id}', [PayoutController::class, 'destroy'])->name('payouts.destroy');


    // register psycholog register.psychologist
    Route::get('/register/psychologist', [PsychologController::class, 'register'])->name('register.psychologist');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('bookings', BookingController::class);
    Route::resource('sessions', SessionMeetController::class);
    Route::resource('transactions', TransactionController::class);
});


require __DIR__ . '/auth.php';
