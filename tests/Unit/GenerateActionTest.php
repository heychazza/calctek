<?php

namespace Tests\Unit;

use App\Actions\GenerateResult;
use PHPUnit\Framework\TestCase;

class GenerateActionTest extends TestCase
{
    public function test_that_addition_returns_correct_result(): void
    {
        $result = GenerateResult::execute("10+10");
        $this->assertEquals(20, $result);
    }
    public function test_that_sqrt_function_returns_correct_result(): void
    {
        $result = GenerateResult::execute("sqrt((((9*9)/12)+(13-4))*2)^2)");
        $this->assertEquals(31.5, $result);
    }
}
