<?php

namespace App\Exchange\Strategy;

class FullStrategy implements ExchangeRateStrategyInterface
{

    public function calculateBuyRate(float $officialRate): float
    {
        return $officialRate - 0.15;
    }

    public function calculateSellRate(float $officialRate): float
    {
        return $officialRate + 0.11;
    }
}
