<?php

namespace App\Services;

use App\HttpClients\CurrencyHttpClient;

class CurrencyService
{
    public static function exchange($data) : float
    {
        $total = $data['total'];
        $charCode = $data['char_code'];
        $currency = CurrencyHttpClient::make()->show($charCode);
        return (float)number_format($currency['Value'] / $currency['Nominal'] * $total, 3, '.', '');
    }
}
