<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use jcubic\Expression;

Route::post('/calculate', function (Request $request, Expression $expression) {

    return response()->json([
        'result' => $expression->evaluate($request->input('expression'))
    ]);
})->name('calculate');
