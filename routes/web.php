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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::group(['namespace' => 'Web', 'middleware' => ['auth', 'user.web']], function () {
    // Route Dashboard
    Route::get('/home', 'HomeController@index')->name('home');

    // Route
    Route::post('tarik', 'PenarikanController@tarik');

    //Route user
    Route::resource('nasabah', 'UserController');
    Route::get('nasabah/{id}', 'UserController@delete')->name('delete_nasabah');//soft delete atau blokir user
    Route::get('trash', 'UserController@trash')->name('trash');//menampilkan data user terblack list
    Route::get('trash/{id}', 'UserController@restore')->name('restore');//mengembalikan data user
    Route::get('permanen/{id}', 'UserController@hapus_permanen')->name('permanen');//hapus permanen user
    Route::get('gudang', 'SampahController@index')->name('gudang');//menampilkan data user terblack list

});
