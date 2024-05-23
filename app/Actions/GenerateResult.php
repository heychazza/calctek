<?php

namespace App\Actions;

use jcubic\Expression;

class GenerateResult
{
    /**
     * Create a new class instance.
     */
    public static function execute(string $equation): string
    {
        $expression = app(Expression::class);

        return $expression->evaluate($equation);
    }
}
