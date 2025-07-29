<?php

namespace App\Exchange\Provider;

interface ExchangeRateProviderInterface
{
    public function getOfficialRate(string $currency): float;
    public function getOfficialRatesForPeriod(string $currency, int $period): array;

}
