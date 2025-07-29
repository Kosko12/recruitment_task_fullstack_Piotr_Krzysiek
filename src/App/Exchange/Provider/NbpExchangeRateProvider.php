<?php

namespace App\Exchange\Provider;

use GuzzleHttp\Client;

class NbpExchangeRateProvider implements ExchangeRateProviderInterface
{
    private const API_URL = 'https://api.nbp.pl/api/exchangerates/rates/A/%s?format=json';

    public function __construct(private Client $httpClient) {}

    public function getOfficialRate(string $currency): float
    {
        $response = $this->httpClient->request('GET', sprintf(self::API_URL, strtoupper($currency)), [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if (!isset($data['rates'][0]['mid'])) {
            throw new \RuntimeException('Unexpected response from NBP API');
        }

        return $data['rates'][0]['mid'];
    }
    public function getOfficialRatesForPeriod(string $currency, int $period): array
    {
        $partialUrl = strtoupper($currency). "/last/" . (string) $period;
        $response = $this->httpClient->request('GET', sprintf(self::API_URL, $partialUrl), [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $today = new \DateTimeImmutable();
        $thresholdDate = $today->modify("-$period days");
        $filteredRates = array_filter($data['rates'], function ($rate) use ($thresholdDate) {
            $rateDate = \DateTimeImmutable::createFromFormat('Y-m-d', $rate['effectiveDate']);
            return $rateDate >= $thresholdDate;
        });
        return $filteredRates;
    }
}
