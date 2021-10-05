<?php

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

Route::get('/', 'UsersController@dashboard')->name('dashboard')->middleware('auth');
Route::get('masuk', 'UsersController@pageLogin')->name('login');

Route::post('proses_masuk', 'UsersController@doSignin')->name('doSignin');
Route::get('catat_uang_masuk', 'UserController@pageCatatUangMasuk')->name('catatUangMasuk')->middleware('auth');
Route::get('catat_uang_keluar', 'UserController@pageCatatUangKeluar')->name('catatUangKeluar')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function() {
    Route::get('perkembangan', 'UserController@pagePerkembangan')->name('perkembangan');
    Route::get('perkembangan', 'UserController@pageLaporanKeseluruhan')->name('laporan_keseluruhan');
});
