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

    Route::post('test/login', 'App\Http\Controllers\AuthController@login');
    Route::post('test/logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('test/refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('test/me', 'App\Http\Controllers\AuthController@me');

    Route::post('test/register', 'App\Http\Controllers\AuthController@register');

    Route::get('test/users', 'App\Http\Controllers\AuthController@index');
    Route::put('test/users/{id}', 'App\Http\Controllers\AuthController@update');
    Route::delete('test/users/{id}', 'App\Http\Controllers\AuthController@destroy');

    
});

