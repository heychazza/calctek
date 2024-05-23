<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use jcubic\Expression;

Route::post('/calculate', function (Request $request, Expression $expression) {
    return $expression->evaluate($request->input('equation'));
});
