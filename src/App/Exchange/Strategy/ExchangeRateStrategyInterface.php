<?php

namespace App\Exchange\Strategy;

interface ExchangeRateStrategyInterface
{
    public function calculateBuyRate(float $officialRate): float;
    public function calculateSellRate(float $officialRate): float;
}
