<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsichologServiceController;
use App\Http\Controllers\PsychologController;
use App\Http\Controllers\PsychologistWeeklyScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionMeetController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use App\Models\PsichologService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.home');
});

Route::get('/cari-psikolog',[GuestController::class,'listPsychologs'])->name('list.psychologs');
Route::get('/cari-psikolog/{id}',[GuestController::class,'detailPsikolog'])->name('detail.psikolog');

Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('jenis-psikolog', TypeController::class);
    Route::resource('topik-keahlian', TopicController::class);
    Route::resource('wilayah-praktik', WilayahController::class);
    Route::resource('users', UserController::class);
    Route::resource('psychologs', PsychologController::class);
    Route::resource('services', ServiceController::class);
    Route::get('/documents/psycholog/{psycholog}', [DocumentController::class, 'show'])
        ->name('documents.show');
    Route::patch(
        '/document-verified/{id}/update-verified',
        [DocumentController::class, 'verified']
    )->name('document.verified');

    Route::patch(
        '/psycholog-verified/{id}/update-verified',
        [PsychologController::class, 'verified']
    )->name('psycholog.verified');

    Route::resource('psycholog-services', PsichologServiceController::class);
    Route::resource('psycholog-weekly-schedules', PsychologistWeeklyScheduleController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('sessions', SessionMeetController::class);
    Route::patch('/room-create/{id}',[SessionMeetController::class,'createRoom'])->name('session.create.room');
    Route::patch('/create-note/{id}',[SessionMeetController::class,'storeNote'])->name('create.note');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
