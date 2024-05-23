<?php

namespace App\Http\Controllers;

use App\Data\TickerTapeData;
use App\Http\Requests\TickerTape\CreateRequest;
use App\Models\TickerTape;
use Exception;
use jcubic\Expression;

class TickerTapeController extends Controller
{
    public function index()
    {
        return inertia('Calculate', [
            'result' => session('result'),
            'history' => TickerTapeData::collect(TickerTape::latest()->get())
        ]);
    }

    public function store(CreateRequest $request, Expression $expression)
    {
        $expr = $request->get('expression');
        try {
            $result = $expression->evaluate($expr);
        } catch (Exception) {
            return back()->withErrors([
                'expression' => "That expression doesn't look right. Please try again."
            ]);
        }

        TickerTape::create([
            'expression' => $expr,
            'result' => $result,
            'created_at' => now()
        ]);

        session()->flash('result', $result);
    }

    public function destroy(TickerTape $tickerTape)
    {
        $tickerTape->delete();
    }
}
