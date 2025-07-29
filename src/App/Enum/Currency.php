<?php

namespace App\Enum;

enum Currency: string
{
    case EUR = 'EUR';
    case USD = 'USD';
    case CZK = 'CZK';
    case BRL = 'BRL';
    case IDR = 'IDR';

    public static function list(): array
    {
        return array_map(fn(self $currency) => $currency->value, self::cases());
    }

    public static function isSupported(string $code): bool
    {
        return in_array(strtoupper($code), self::list(), true);
    }
}
