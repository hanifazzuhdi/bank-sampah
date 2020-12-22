<?php

use App\Http\Controllers\Api\PenyetoranController;
use App\Http\Controllers\Api\SampahController;
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


Route::group(['namespace' => 'Api', 'middleware' => 'jwt.verify'], function () {
    // Route User
    Route::get('profile', 'ProfileController@index'); //menampilkan profil user yang sedang login
    Route::post('profile', 'ProfileController@update'); //mengupdate profile
    Route::post('ganti', 'ProfileController@change'); //ganti password

    // Route penyetoran
    Route::post('setor', 'PenyetoranController@store');
    Route::post('jemput', 'PenyetoranController@jemput');
    Route::post('setorDriver/{fee}', 'PenyetoranController@store');

    // Route Transaksi

    Route::get('getSaldo', 'TransaksiController@index');

    // Route Gudang sampah
    Route::get('getSampah', 'SampahController@index');
    Route::get('getSampah/{id}', 'SampahController@show');
});
