<?php

namespace App\HttpClients;

use App\Exceptions\CurrencyException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CurrencyHttpClient
{
    private static ?CurrencyHttpClient $instance = null;
    public static function make() : CurrencyHttpClient
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function index() : Collection
    {
        return Http::cbr()
            ->get('/daily_json.js')
            ->collect('Valute');
    }
    public function show(string $charCode) : Collection
    {
        $charCode = strtoupper($charCode);
        $currencies = $this->index();
        if (!isset($currencies[$charCode])) {
            throw new CurrencyException('Currency not found', 404);
        }
        return collect($currencies[$charCode]);
    }
}
