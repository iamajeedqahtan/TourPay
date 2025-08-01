<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MadaCardController;
use App\Http\Controllers\UserCardController;
use App\Http\Controllers\NfcPaymentController;
use App\Http\Controllers\TopUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mada-card/create', [MadaCardController::class, 'create'])->name('mada.create');
    Route::post('/mada-card/store', [MadaCardController::class, 'store'])->name('mada.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cards/create', [UserCardController::class, 'create'])->name('cards.create');
    Route::post('/cards', [UserCardController::class, 'store'])->name('cards.store');
    Route::delete('/cards/{card}', [UserCardController::class, 'destroy'])->name('cards.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/nfc/pay', [NfcPaymentController::class, 'index'])->name('nfc.pay');
    Route::post('/nfc/pay', [NfcPaymentController::class, 'process'])->name('nfc.pay.process');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wallet/topup', [TopUpController::class, 'create'])->name('wallet.topup');
    Route::post('/wallet/topup', [TopUpController::class, 'store'])->name('wallet.topup.store');
});

require __DIR__.'/auth.php';
