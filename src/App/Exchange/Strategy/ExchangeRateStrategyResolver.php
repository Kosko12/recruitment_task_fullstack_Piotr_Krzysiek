<?php

namespace App\Exchange\Strategy;

class ExchangeRateStrategyResolver
{
    public function __construct(
        private ExchangeRateStrategyInterface $sellOnlyStrategy,
        private ExchangeRateStrategyInterface $buySellStrategy
    ) {}

    public function resolve(string $type): ExchangeRateStrategyInterface
    {
        return match (strtoupper($type)) {
            "EUR", "USD" => $this->buySellStrategy,
            default => $this->sellOnlyStrategy,
        };
    }
}
