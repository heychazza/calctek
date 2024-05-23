<?php

use App\Http\Controllers\TickerTapeController;
use Illuminate\Support\Facades\Route;

Route::get('/calculator', [TickerTapeController::class, 'index'])->name('calculator');

Route::resource('/tickertape', TickerTapeController::class)->parameters([
    'tickertape' => 'tickerTape'
])->only([ 'store', 'destroy']);
