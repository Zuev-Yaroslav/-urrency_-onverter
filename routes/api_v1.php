<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

});
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::group(['prefix' => 'currencies'], function () {
        Route::get('/', [CurrencyController::class, 'index']);
        Route::get('/exchange', [CurrencyController::class, 'exchange']);
        Route::get('/{charCode}', [CurrencyController::class, 'show']);
    });
});
