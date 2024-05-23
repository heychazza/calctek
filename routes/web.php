<?php

use App\Actions\GenerateResult;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return GenerateResult::execute('2 + 2');
});
