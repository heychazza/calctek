<?php

use App\Http\Controllers\ClearTickerTapeController;
use App\Http\Controllers\TickerTapeController;
use Illuminate\Support\Facades\Route;

Route::get('/calculator', [TickerTapeController::class, 'index'])->name('calculator');

Route::delete('/tickertape/clear', [ClearTickerTapeController::class, 'destroy'])->name('tickertape.clear');

Route::resource('/tickertape', TickerTapeController::class)->parameters([
    'tickertape' => 'tickerTape'
])->only([ 'store', 'destroy']);
