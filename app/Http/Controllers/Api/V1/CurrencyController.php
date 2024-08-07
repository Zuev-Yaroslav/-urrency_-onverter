<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Currency\ExchangeRequest;
use App\Http\Resources\Currency\CurrencyResource;
use App\HttpClients\CurrencyHttpClient;
use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        return CurrencyResource::collection(CurrencyHttpClient::make()->index())->resolve();
    }
    public function show(string $charCode)
    {
        return CurrencyResource::make(CurrencyHttpClient::make()->show($charCode))->resolve();
    }
    public function exchange(ExchangeRequest $request)
    {
        $data = $request->validated();

        $result = CurrencyService::exchange($data);

        return $this->getExchangeResponse($result);
    }
    private function getExchangeResponse(float $result) : JsonResponse
    {
        return response()->json([
            'result' => $result,
            'toCurrency' => 'RUB'
        ], 200);
    }
}
