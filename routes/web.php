<?php

use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CalculateController::class, 'index']);

Route::post('/calculate', [CalculateController::class, 'store'])->name('calculate');
