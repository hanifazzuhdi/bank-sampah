<?php

use App\Http\Controllers\Web\KaryawanController;
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

Route::group(['namespace' => 'Web', 'middleware' => ['user.web']], function () {

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
    Route::get('sampah', 'SampahController@getSampah')->name('sampah.index');             //menampilkan data List sampah
    Route::get('sampah/{id}', 'SampahController@show');                                   //menampilkan jenis berdasarkan id
    Route::post('sampah', 'SampahController@store')->name('sampah.store');                //Membuat jenis sampah baru
    Route::put('sampah/{id}/update', 'SampahController@update');                          //Update jenis sampah
    Route::delete('sampah/{id}', 'SampahController@destroy');                             //Menghapus jenis sampah
    // Gudang
    Route::get('gudang', 'SampahController@getGudang')->name('gudang.index');             //menampilkan data gudang sampah


    //Route keuangan bank
    Route::get('keuangan', 'KeuanganController@index')->name('keuangan'); //menampilkan data keuangan bank sampah dan saldo
    Route::post('tarik', 'PenarikanController@tarik')->name('admin_tarik'); //menarik saldo oleh admin dari keuangan

    //Route bendahara
    Route::get('penarikan', 'PenarikanController@index')->name('tarik_sis'); //menampilkan data user
    Route::get('saldo/{id}', 'BendaharaController@saldo')->name('saldo'); //menampilkan data saldo user dan request penarikanya berdasarkan id
    Route::post('penarikan/{id}', 'BendaharaController@tarik')->name('penarikan'); //mengkonfirmasi penarikan nasabah oleh bendahara

    //Route penyetoran
    Route::get('penyetoran', 'BendaharaController@penyetoran')->name('penyetoran'); //menampilkan riwayan penyetoran

});
