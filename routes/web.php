<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsychologController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('jenis-psikolog', TypeController::class);
    Route::resource('topik-keahlian', TopicController::class);
    Route::resource('wilayah-praktik', WilayahController::class);
    Route::resource('users', UserController::class);
    Route::resource('psychologs', PsychologController::class);
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


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
