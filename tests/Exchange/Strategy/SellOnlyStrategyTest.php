<?php

namespace App\Tests\Exchange\Strategy;

use PHPUnit\Framework\TestCase;
use App\Exchange\Strategy\SellStrategy;

class SellOnlyStrategyTest extends TestCase
{
    public function testCalculateSellRate()
    {
        $strategy = new SellStrategy();

        $this->assertEquals(5.20, $strategy->calculateSellRate(5.00));
        $this->assertEquals(3.70, $strategy->calculateSellRate(3.50));
    }

    public function testCalculateBuyRateThrowsException()
    {
        $this->expectException(\LogicException::class);

        $strategy = new SellStrategy();
        $strategy->calculateBuyRate(5.00);
    }
}
