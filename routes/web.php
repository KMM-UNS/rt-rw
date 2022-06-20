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

Route::get('/token', function () {
    return csrf_token();
});

Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {
    Route::view('/', 'home')->name('home');

    // Route::get('/', function () {
    //     return redirect(route('user.keluarga.index'));
    // });
    // // Route::resource('/', 'KeluargaController');


    // Route::resource('/userdashboard', 'KeluargaController');

    Route::group(['namespace' => 'User'], function () {
        Route::group(['prefix' => '/petugas', 'as' => 'petugas', 'namespace' => 'PetugasIuran'], function () {
            Route::resource('petugas', 'PetugasController');
        });

        Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga'], function () {
            // Route::get('bayar-iuranwajib', 'KeluargaaController');

            // Route::get('bayar-iuranwajib/status', 'KeluargaaController@changeMemberStatus');
            Route::get('/update/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
            Route::resource('bayar-iuranwajib', 'KeluargaaController');
            Route::resource('warga', 'WargaController');

            // Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
            // Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
            // Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
        });

        Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT'], function () {
            Route::resource('kas-iuranwajib', 'KasIuranWajibController');
            Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
            Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
            Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
        });
    });
});


require __DIR__ . '/demo.php';
