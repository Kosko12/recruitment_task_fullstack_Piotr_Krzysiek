<?php

namespace App\Service;

use App\Exchange\Provider\ExchangeRateProviderInterface;
use App\Exchange\Strategy\ExchangeRateStrategyResolver;

class ExchangeService
{
    public function __construct(
        private ExchangeRateProviderInterface $provider,
        private ExchangeRateStrategyResolver $resolver
    ) {}

    public function getRates(string $currency): array
    {
        $officialRate = $this->provider->getOfficialRate($currency);
        $strategy = $this->resolver->resolve($currency);

        $buyRate = null;
        $sellRate = null;

        try {
            $buyRate = $strategy->calculateBuyRate($officialRate);
        } catch (\Throwable $e) {
        }

        try {
            $sellRate = $strategy->calculateSellRate($officialRate);
        } catch (\Throwable $e) {
        }

        return [
            'currency'      => strtoupper($currency),
            'officialRate'  => $officialRate,
            'buyRate'       => $buyRate,
            'sellRate'      => $sellRate,
        ];
    }

    public function getSpecificRatesHistory($currency, $days) {
        return $this->provider->getOfficialRatesForPeriod($currency, $days);
    }

    public function getBuyRate(string $currency, string $strategyType): float
    {
        $rate = $this->provider->getOfficialRate($currency);
        $strategy = $this->resolver->resolve($strategyType);

        return $strategy->calculateBuyRate($rate);
    }

    public function getSellRate(string $currency, string $strategyType): float
    {
        $rate = $this->provider->getOfficialRate($currency);
        $strategy = $this->resolver->resolve($strategyType);

        return $strategy->calculateSellRate($rate);
    }
}
