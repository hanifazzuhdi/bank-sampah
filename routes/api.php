<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('coba', 'Api\HomeController@nasabah'); //mengirim email reset password

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//route reset password
Route::post('password/email', 'Api\ForgotPasswordController@forgot'); //mengirim email reset password
Route::post('password/reset', 'Api\ForgotPasswordController@reset');

// Route Auth
Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');

Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend'); //kirim email verivikasi
Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify'); //kirim email verivikasi

Route::group(['namespace' => 'Api', 'middleware' => 'jwt.verify'], function () {

    // Route User          -> Nasabah, Pengurus1, Pengurus2
    Route::get('profile', 'ProfileController@index')->middleware('verified');   //menampilkan profil user yang sedang login
    Route::post('profile', 'ProfileController@update')->middleware('verified'); //mengupdate profile
    Route::post('ganti', 'ProfileController@change');   //ganti password
    Route::get('gett', 'ProfileController@gett');       //route percobaan

    // Route penyetoran    -> Nasabah
    Route::get('historyPenjemputan', 'PenyetoranController@historyPenjemputan');    //Melihat History penjemputan sampah
    Route::post('setorDriver/{fee}/{id}', 'PenyetoranController@store');            //Nasabah Setor Sampah Dijemput Driver
    Route::post('setor', 'PenyetoranController@store');                             //Nasabah Antar Sampah sendiri ke gudang
    Route::post('jemput', 'PenyetoranController@jemput');                           //Nasabah minta permintaan jemput sampah oleh driver

    // Route Transaksi     -> Nasabah
    Route::get('getTabungan', 'TransaksiController@index');     //untuk melihat buku tabungan nasabah
    Route::get('getSaldo', 'TransaksiController@show');         //untuk melihat saldo nasabah
    Route::get('riwayat/tarik', 'TransaksiController@riwayat'); //Melihat riwayat penarikan saldo
    Route::post('tarikSaldo', 'TransaksiController@tarik');     //tarik saldo nasabah oleh nasabah

    // Route Gudang sampah  -> Nasabah, Pengurus1, Pengurus2
    Route::get('getSampah', 'SampahController@index');        // Melihat Sampah Yang ada di gudang
    Route::post('setorDriver/{fee}', 'PenyetoranController@store');    //pengurus satu Setor Sampah Dijemput Driver
    Route::post('setor', 'PenyetoranController@store');     //Nasabah Antar Sampah sendiri ke gudang
    Route::get('getSampah/{id}', 'SampahController@show');    // Melihat Sampah berdasarkan id jenisnya
    Route::get('getJenis', 'SampahController@getJenis');      // Melihat Jenis Sampah Dilayani

    // Route Penjualan      -> Pengurus 2
    Route::get('gudang', 'PenjualanController@index');   //untuk melihat kapasitas sampah di gudang
    Route::post('sell', 'PenjualanController@store');    //menginput hasil penjualan

    //Route penjemputan     -> Pengurus 1
    Route::get('penjemputan/daftar', 'PenjemputanController@index');                                    //melihat permintaan penjemputan
    Route::get('penjemputan/selesai', 'PenjemputanController@selesai');                                  //melihat yang sudah dijemput
    Route::get('penjemputan/penolakan', 'PenjemputanController@penolakan');                              //melihat yang tidak mau dijemput
    Route::post('penjemputan/penolakan/{penjemputan}', 'PenjemputanController@tolak');                   //menolak permintaan penjemputan
    Route::post('penjemputan/konfirmasi/{penjemputan}', 'PenjemputanController@konfirmasiPenjemputan');  //konfirmasi penjemputan

    //Route chat            -> Nasabah dan Pengurus 1
    Route::get('allmessage', 'ChatController@index');      //ambil semua pesan
    Route::get('chat/{id}', 'ChatController@getChat');     //buat nge get pesan
    Route::post('chat/{id}', 'ChatController@sendChat');   //buat ngirim pesan
    Route::delete('chat/{id} ', 'ChatController@destroy'); //hapus pesan

});
