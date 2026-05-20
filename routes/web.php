<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

// Misafir Kullanıcı Rotaları (Giriş ve Kayıt)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [QuoteController::class, 'showLogin'])->name('login');
    Route::get('/giris', [QuoteController::class, 'showLogin']);
    Route::post('/giris', [QuoteController::class, 'login']);
    Route::get('/kayit', [QuoteController::class, 'showRegister'])->name('register');
    Route::post('/kayit', [QuoteController::class, 'register']);
});

// Giriş Yapmış Kullanıcı Rotaları (Duygu Durağı Ana Akış)
Route::middleware(['auth'])->group(function () {
    Route::get('/duygu-duragi', [QuoteController::class, 'index'])->name('quotes.index');
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::post('/quotes/{quote}/like', [QuoteController::class, 'like'])->name('quotes.like');
    Route::get('/random-inspiration', [QuoteController::class, 'random'])->name('quotes.random');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
    Route::post('/cikis', [QuoteController::class, 'logout'])->name('logout');

    //PROFİL ROTALARI
    Route::get('/profil', [QuoteController::class, 'profile'])->name('profile.show');
    Route::get('/profil/duzenle', [QuoteController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profil/guncelle', [QuoteController::class, 'updateProfile'])->name('profile.update');
});

