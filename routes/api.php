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


Route::group(['namespace' => 'Api', 'middleware' => 'jwt.verify'], function () {
    // Route User
    Route::get('profile', 'ProfileController@index'); //menampilkan profil user yang sedang login
    Route::post('profile', 'ProfileController@update'); //mengupdate profile
    Route::post('ganti', 'ProfileController@change'); //ganti password
    Route::get('gett', 'ProfileController@gett'); //route percobaan

    // Route penyetoran
    Route::get('historyPenjemputan', 'PenyetoranController@historyPenjemputan');
    Route::post('konfirmasiPenjemputan/{penjemputan}', 'PenyetoranController@konfirmasiPenjemputan');
    Route::post('setorDriver/{fee}', 'PenyetoranController@store');
    Route::post('setor', 'PenyetoranController@store');
    Route::post('jemput', 'PenyetoranController@jemput');

    // Route Transaksi
    Route::get('getTabungan', 'TransaksiController@index'); //untuk melihat buku tabungan nasabah
    Route::get('getSaldo', 'TransaksiController@show'); //untuk melihat saldo nasabah
    Route::post('tarikSaldo/{nominal}', 'TransaksiController@tarik'); //tarik saldo nasabah oleh nasabah

    // Route Gudang sampah
    Route::get('getSampah', 'SampahController@index');
    Route::get('getSampah/{id}', 'SampahController@show');
    Route::get('getJenis', 'SampahController@getJenis');

    // Route Penjualan
    Route::get('saldo', 'PenjualanController@index'); //mengambil jumlah saldo
    Route::post('sell', 'PenjualanController@store'); //menginput hasil penjualan

    //Route penjemputan
    Route::get('daftar', 'PenjemputanController@index'); //melihat permintaan penjemputan
    Route::get('selesai', 'PenjemputanController@selesai'); //melihat yang sudah dijemput
    Route::get('penolakan', 'PenjemputanController@penolakan'); //melihat yang tidak mau dijemput
    Route::post('penolakan/{penjemputan}', 'PenjemputanController@tolak'); //menolak permintaan penjemputan

    //Route chat
    Route::get('allmessage', 'ChatController@index'); //ambil semua pesan
    Route::get('/chat/{id}', 'ChatController@getChat'); // buat nge get pesan
    Route::post('chat/{id}', 'ChatController@sendChat'); // buat ngirim pesan
    Route::delete('chat/{id} ', 'ChatController@destroy'); //hapus pesan

});
