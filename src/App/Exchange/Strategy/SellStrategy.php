<?php

namespace App\Exchange\Strategy;

class SellStrategy implements ExchangeRateStrategyInterface 
{

    function calculateSellRate(float $officialRate): float
    {
        return $officialRate + 0.2;
    }
    function calculateBuyRate(float $officialRate): float
    {
        throw new \LogicException('Unsupported operation!');
    }
}