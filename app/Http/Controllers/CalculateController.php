<?php

namespace App\Http\Controllers;

use App\Models\TickerTape;
use Exception;
use Illuminate\Http\Request;
use jcubic\Expression;

class CalculateController extends Controller
{
    public function index()
    {
        return inertia('Calculate', [
            'result' => session('result'),
            'history' => TickerTape::query()->latest()->limit(10)->get()
        ]);
    }

    public function store(Request $request, Expression $expression)
    {
        $request->validate([
            'expression' => 'required|string'
        ]);

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
