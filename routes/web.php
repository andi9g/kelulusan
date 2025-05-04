<?php

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

Route::get('/', 'showC@root');
Route::get('/show', 'showC@index');
Route::get('/datakelulusan', 'showC@datakelulusan');
Route::post('/show', 'showC@lihatlulus')->name('lihat.lulus');

Route::get('login', 'loginC@index');
Route::get('logout', 'loginC@logout');
Route::post('login', 'loginC@proses')->name('login.proses');

Route::middleware(['GerbangLogin'])->group(function () {
    Route::get('kelulusan', 'kelulusanC@index');

    Route::post('kelulusan/buku/{nisn}', 'kelulusanC@buku')->name('kelulusan.buku')->middleware('GerbangPerpus');
    Route::delete('kelulusan/buku/hapus/{nisn}', 'kelulusanC@hapusbuku')->name('kelulusan.buku.hapus')->middleware('GerbangPerpus');

    Route::middleware(['GerbangTu'])->group(function () {
        Route::post('kelulusan/spp/{nisn}', 'kelulusanC@spp')->name('kelulusan.spp');
        Route::delete('kelulusan/spp/hapus/{nisn}', 'kelulusanC@hapusspp')->name('kelulusan.spp.hapus');

        Route::post("generate/kelulusan", "kelulusanC@generate")->name("generate.passid");
        Route::get("cetaklaporanpassid", "kelulusanC@cetak")->name("cetak.laporan");

        Route::post('kelulusan/lulus/{nisn}', 'kelulusanC@lulus')->name('kelulusan.lulus');
        Route::post('kelulusan/semua/lulus', 'kelulusanC@lulussemua')->name('kelulusan.lulus.semua');
        Route::delete('kelulusan/semua/reset', 'kelulusanC@lulusreset')->name('kelulusan.lulus.reset');
    });

    Route::middleware(['GerbangSuperadmin'])->group(function () {
        Route::get('pengaturan', 'pengaturanC@index');
        Route::post('pengaturan/open1', 'pengaturanC@open1')->name('pengaturan.open1');
        Route::post('pengaturan/open2', 'pengaturanC@open2')->name('pengaturan.open2');
        Route::resource('admin', 'adminC');
    });


    Route::put('ubahpassword', 'loginC@ubahpassword')->name('ubah.password');

});
