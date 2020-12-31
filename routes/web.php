<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Web', 'middleware' => ['auth', 'user.web']], function () {

    // Route Dashboard      -> Admin, Bendahara
    Route::get('/home', 'HomeController@index')->name('home');

    // Route Karyawan       -> Admin
    Route::get('/karyawan', 'KaryawanController@index')->name('karyawan.index');
    Route::get('/karyawan/{id}', 'KaryawanController@show')->name('karyawan.show');
    Route::post('/karyawan/store', 'KaryawanController@store')->name('karyawan.store');
    Route::put('/karyawan/update/{id}', 'KaryawanController@update');
    Route::delete('/karyawan/delete/{id}', 'KaryawanController@destroy');

    //Route Naasabah        -> Admin
    Route::get('nasabah', 'UserController@index')->name('nasabah.index');
    Route::get('trash', 'UserController@trash')->name('trash');                     //menampilkan data user terblack list
    Route::get('nasabah/{id}', 'UserController@delete')->name('delete_nasabah');    //soft delete atau blokir user
    Route::get('trash/{id}', 'UserController@restore')->name('restore');            //mengembalikan data user
    Route::get('permanen/{id}', 'UserController@hapus_permanen')->name('permanen'); //hapus permanen user

    // Route Sampah         -> Admin
    Route::get('sampah', 'SampahController@getSampah')->name('sampah.index'); //menampilkan data List sampah
    Route::get('gudang', 'SampahController@getGudang')->name('gudang.index'); //menampilkan data gudang sampah

    // Route
    Route::post('tarik', 'PenarikanController@tarik');

    //Route keuangan
    Route::get('keuangan', 'KeuanganController@index')->name('keuangan'); //menampilkan data keuangan bank sampah

    //Route penarikan
    Route::get('penarikan', 'PenarikanController@index')->name('penarikan'); //menampilkan data user

});
