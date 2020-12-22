<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Auth
Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');

// Middleware JWT
Route::group(['middleware' => 'jwt.verify'], function () {
    // Route penyetoran
    Route::post('setor', 'Api\PenyetoranController@store');
    Route::post('jemput', 'Api\PenyetoranController@jemput');

    // Route Transaksi
    Route::post('addSaldo', 'TransaksiController@addSaldo');
});
