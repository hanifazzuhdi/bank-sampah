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

    // Route User          -> Nasabah, Pengurus1, Pengurus2
    Route::get('profile', 'ProfileController@index');   //menampilkan profil user yang sedang login
    Route::post('profile', 'ProfileController@update'); //mengupdate profile
    Route::post('ganti', 'ProfileController@change');   //ganti password
    Route::get('gett', 'ProfileController@gett');       //route percobaan

    // Route penyetoran    -> Nasabah
    Route::get('historyPenjemputan', 'PenyetoranController@historyPenjemputan');    //Melihat History penjemputan sampah
    Route::post('setorDriver/{fee}', 'PenyetoranController@store');                 //Nasabah Setor Sampah Dijemput Driver
    Route::post('setor', 'PenyetoranController@store');                             //Nasabah Antar Sampah sendiri ke gudang
    Route::post('jemput', 'PenyetoranController@jemput');                           //Nasabah minta permintaan jemput sampah oleh driver

    // Route Transaksi     -> Nasabah
    Route::get('getTabungan', 'TransaksiController@index');             //untuk melihat buku tabungan nasabah
    Route::get('getSaldo', 'TransaksiController@show');                 //untuk melihat saldo nasabah
    Route::post('tarikSaldo/{nominal}', 'TransaksiController@tarik');   //tarik saldo nasabah oleh nasabah

    // Route Gudang sampah  -> Nasabah, Pengurus1, Pengurus2
    Route::get('getSampah', 'SampahController@index');        // Melihat Sampah Yang ada di gudang
    Route::get('getSampah/{id}', 'SampahController@show');    // Melihat Sampah berdasarkan id jenisnya
    Route::get('getJenis', 'SampahController@getJenis');      // Melihat Jenis Sampah Dilayani

    // Route Penjualan      -> Pengurus 2
    Route::post('sell', 'PenjualanController@store');    //menginput hasil penjualan

    //Route penjemputan     -> Pengurus 1
    Route::get('penjemputan/daftar', 'PenjemputanController@index');                                    //melihat permintaan penjemputan
    Route::get('penjemputan/selesai', 'PenjemputanController@selesai');                                 //melihat yang sudah dijemput
    Route::get('penjemputan/penolakan', 'PenjemputanController@penolakan');                             //melihat yang tidak mau dijemput
    Route::post('penjemputan/penolakan/{penjemputan}', 'PenjemputanController@tolak');                  //menolak permintaan penjemputan
    Route::post('konfirmasiPenjemputan/{penjemputan}', 'PenjemputanController@konfirmasiPenjemputan');  //konfirmasi penjemputan

    //Route chat
    Route::get('allmessage', 'ChatController@index');       //ambil semua pesan
    Route::get('/chat/{id}', 'ChatController@getChat');     // buat nge get pesan
    Route::post('chat/{id}', 'ChatController@sendChat');    // buat ngirim pesan
    Route::delete('chat/{id} ', 'ChatController@destroy');  //hapus pesan
});
