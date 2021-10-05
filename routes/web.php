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
Route::get('catat_uang_masuk', 'UsersController@pageCatatUangMasuk')->name('catatUangMasuk')->middleware('auth');
Route::get('catat_uang_keluar', 'UsersController@pageCatatUangKeluar')->name('catatUangKeluar')->middleware('auth');
Route::get('riwayat', 'UsersController@pageRiwayat')->name('riwayat')->middleware('auth');
Route::get('laporan', 'UsersController@pageLaporan')->name('laporan')->middleware('auth');
Route::get('logout', 'UsersController@logout')->name('logout')->middleware('auth');

Route::get('editRiwayat/{id}', 'UsersController@pageEditRiwayat')->name('editRiwayat')->middleware('auth')->where('id', '(INC|OUT)-[0-9]+');

Route::post('proses_masuk', 'UsersController@doSignin')->name('doSignin');
Route::post('prosesCatatUangMasuk', 'CatatanController@prosesCatatUangMasuk')->name('prosesCatatUangMasuk')->middleware('auth');
Route::post('prosesCatatUangKeluar', 'CatatanController@prosesCatatUangKeluar')->name('prosesCatatUangKeluar')->middleware('auth');
Route::post('prosesEditCatatan', 'CatatanController@prosesEditCatatan')->name('prosesEditCatatan')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function() {
    Route::get('perkembangan', 'UsersController@pagePerkembangan')->name('perkembangan');
    Route::get('laporan_keseluruhan', 'UsersController@pageLaporanKeseluruhan')->name('laporan_keseluruhan');
});
