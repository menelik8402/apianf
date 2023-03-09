<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1'

],
function ($router) {

    Route::post('accounts/login', 'App\Http\Controllers\AuthController@login');
    Route::post('accounts/logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('accounts/refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('accounts/me', 'App\Http\Controllers\AuthController@me');
    Route::post('accounts/register', 'App\Http\Controllers\AuthController@register');
    Route::get('accounts/checkemail/{email}', 'App\Http\Controllers\AuthController@checkemail');
    Route::get('preferences/initialpreferences', 'App\Http\Controllers\FilterController@index');
    Route::get('gift/giftsbypreference/{filter}', 'App\Http\Controllers\GiftController@getGiftByFilter');
});

