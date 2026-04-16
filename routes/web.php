<?php

use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('welcome');
});
*/
use App\Http\Controllers\QuoteController;

Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');

Route::get('/', [QuoteController::class, 'index']);
Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
