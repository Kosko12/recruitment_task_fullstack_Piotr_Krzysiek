<?php

namespace App\Tests\Exchange\Strategy;

use PHPUnit\Framework\TestCase;
use App\Exchange\Strategy\FullStrategy;

class FullStrategyTest extends TestCase
{
    public function testCalculateBuyRate()
    {
        $strategy = new FullStrategy();

        $this->assertEquals(4.85, $strategy->calculateBuyRate(5.00));
        $this->assertEquals(3.35, $strategy->calculateBuyRate(3.50));
        $this->assertEquals(0.00, $strategy->calculateBuyRate(0.15));
    }

    public function testCalculateSellRate()
    {
        $strategy = new FullStrategy();

        $this->assertEquals(5.11, $strategy->calculateSellRate(5.00));
        $this->assertEquals(3.61, $strategy->calculateSellRate(3.50));
        $this->assertEquals(0.11, $strategy->calculateSellRate(0.00));
    }
}
