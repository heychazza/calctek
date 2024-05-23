<?php

namespace App\Http\Controllers;

use App\Models\TickerTape;

class ClearTickerTapeController extends Controller
{
    public function destroy()
    {
        TickerTape::truncate();
    }
}
