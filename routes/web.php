<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('errors.404');
});

Route::group(['namespace' => 'Web', 'middleware' => ['user.web']], function () {

    // Route Dashboard      -> Admin, Bendahara
    Route::get('/home', 'HomeController@index')->name('home');  //Dashboard

    // Route Karyawan       -> Admin
    Route::get('/karyawan', 'KaryawanController@index')->name('karyawan.index');        //menampilkan data karyawan
    Route::get('/karyawan/{id}', 'KaryawanController@show')->name('karyawan.show');     //menampilkan karyawan per id
    Route::post('/karyawan/store', 'KaryawanController@store')->name('karyawan.store'); //membuat karyawan baru oleh admin
    Route::put('/karyawan/update/{id}', 'KaryawanController@update');                   //update data karyawan
    Route::delete('/karyawan/delete/{id}', 'KaryawanController@destroy');               //hapus permanen data karyawan

    //Route Naasabah        -> Admin
    Route::get('nasabah', 'UserController@index')->name('nasabah.index');                    //menampilkan data user
    Route::get('nasabah-blacklist', 'UserController@blacklist')->name('nasabah.blacklist');  //menampilkan data user terblack list
    Route::get('nasabah/tabungan/{id}', 'UserController@tabungan');                          // menampilkan buku tabungan nasabah
    Route::post('nasabah/store', 'UserController@store')->name('nasabah.store');             //buat user baru oleh admin
    Route::post('nasabah/blacklist/{id}', 'UserController@softDelete');                      //soft delete atau blokir user
    Route::post('nasabah/restore/{id}', 'UserController@restore');                           //mengembalikan data user
    Route::post('nasabah/delete/{id}', 'UserController@delete');                             //hapus permanen user

    // Route Sampah         -> Admin
    Route::get('sampah', 'SampahController@getSampah')->name('sampah.index');             //menampilkan data List sampah
    Route::get('sampah/{id}', 'SampahController@show');                                   //menampilkan jenis berdasarkan id
    Route::post('sampah', 'SampahController@store')->name('sampah.store');                //Membuat jenis sampah baru
    Route::put('sampah/{id}/update', 'SampahController@update');                          //Update jenis sampah
    Route::delete('sampah/{id}', 'SampahController@destroy');                             //Menghapus jenis sampah
    // Gudang
    Route::get('gudang', 'SampahController@getGudang')->name('gudang.index');             //menampilkan data gudang sampah

    //Route keuangan bank   -> Admin, Bendahara
    Route::get('keuangan', 'KeuanganController@index')->name('keuangan.index');       //menampilkan data keuangan bank sampah dan saldo

    //Route penyetoran      -> Admin, Bendahara
    Route::get('penyetoran', 'BendaharaController@penyetoran')->name('bendahara.penyetoran'); //menampilkan riwayat penyetoran

    // Route Penjualan      -> Andmin, Bendahara
    Route::get('penjualan', 'BendaharaController@penjualan')->name('bendahara.penjualan');  //Menampilkan data penjualan

    //Route Penarikan       -> Bendahara
    Route::get('penarikan-tunai', 'KeuanganController@getPenarikan')->name('keuangan.penarikan');            //menampilkan form penarikan
    Route::get('penarikan-permintaan', 'KeuanganController@getPermintaan')->name('keuangan.permintaan');     //menampilkan data permintaan
    Route::post('penarikan/tunai/store', 'KeuanganController@penarikan')->name('keuangan.tarik');            //Kirim form penarikan tunai
    Route::post('penarikan/konfirmasi/{id}', 'KeuanganController@konfirmasi');
    Route::post('penarikan/tolak/{id}', 'KeuanganController@tolak');

    // Route ajax
    Route::get('alert', 'HomeController@alert');
});
