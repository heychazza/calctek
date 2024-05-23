<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript */
class TickerTapeData extends Data
{
    public function __construct(
        public int $id,
        public string $expression,
        public float $result
    ) {}
}
