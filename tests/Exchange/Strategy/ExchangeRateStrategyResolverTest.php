<?php

namespace App\Tests\Exchange\Strategy;

use PHPUnit\Framework\TestCase;
use App\Exchange\Strategy\ExchangeRateStrategyResolver;
use App\Exchange\Strategy\ExchangeRateStrategyInterface;

class ExchangeRateStrategyResolverTest extends TestCase
{
    private ExchangeRateStrategyInterface $sellOnlyStrategyMock;
    private ExchangeRateStrategyInterface $buySellStrategyMock;

    protected function setUp(): void
    {
        $this->sellOnlyStrategyMock = $this->createMock(ExchangeRateStrategyInterface::class);
        $this->buySellStrategyMock = $this->createMock(ExchangeRateStrategyInterface::class);
    }

    public function testResolvesBuySellStrategyForUsdAndEur()
    {
        $resolver = new ExchangeRateStrategyResolver(
            $this->sellOnlyStrategyMock,
            $this->buySellStrategyMock
        );

        $this->assertSame(
            $this->buySellStrategyMock,
            $resolver->resolve("EUR"),
            'Expected buySellStrategy for EUR'
        );

        $this->assertSame(
            $this->buySellStrategyMock,
            $resolver->resolve("usd"),
            'Expected buySellStrategy for USD (case insensitive)'
        );
    }

    public function testResolvesSellOnlyStrategyForOtherCurrencies()
    {
        $resolver = new ExchangeRateStrategyResolver(
            $this->sellOnlyStrategyMock,
            $this->buySellStrategyMock
        );

        $this->assertSame(
            $this->sellOnlyStrategyMock,
            $resolver->resolve("PLN"),
            'Expected sellOnlyStrategy for PLN'
        );

        $this->assertSame(
            $this->sellOnlyStrategyMock,
            $resolver->resolve("CZK"),
            'Expected sellOnlyStrategy for CZK'
        );
    }
}
