<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Warga\WargaController;

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

//versi asli

Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {
    Route::view('/', 'home')->name('home');

    Route::group(['namespace' => 'User'], function () {

        Route::group(['prefix' => '/petugas-iuran', 'as' => 'petugas-iuran.', 'namespace' => 'PetugasIuran', 'middleware' => ['auth', 'petugas']], function () {
            // Route::resource('petugas', 'PetugasController');
            Route::resource('data-petugas', 'PetugasController');
        });

        Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga', 'middleware' => ['auth', 'petugas']], function () {
            Route::get('/updatewajib/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
            Route::get('/updatesukarela/status/{id}', 'BayarSukarelaController@status')->name('bayar-iuransukarela.status');
            Route::get('/updatekondisional/status/{id}', 'BayarKondisionalController@status')->name('bayar-iurankondisional.status');
            Route::get('/updateagenda/status/{id}', 'BayarAgendaController@status')->name('bayar-iuranagenda.status');
            Route::resource('bayar-iuranwajib', 'KeluargaaController');
            Route::resource('bayar-iuransukarela', 'BayarSukarelaController');
            Route::resource('bayar-iurankondisional', 'BayarKondisionalController');
            Route::resource('bayar-iuranagenda', 'BayarAgendaController');
            Route::resource('warga', 'WargaController');
            // Route::get('/wargak/status', 'WargaController@wargah');
            // Route::resource('wargak', 'WargaController');
            // Route::view('/wargak', 'wargaa')->name('wargaa');
        });

        Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT', 'middleware' => ['auth', 'petugas']], function () {
            Route::resource('kas-iuranwajib', 'KasIuranWajibController');
            Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
            Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
            Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
        });

        Route::group(['prefix' => '/warga', 'as' => 'warga.', 'namespace' => 'StatusIuranWarga', 'middleware' => ['auth', 'warga']], function () {
            // Route::get('/wargak/status', 'WargaController@wargah');
            // Route::resource('wargak', 'WargaController');
            Route::resource('/wargak', 'WargaController');
        });
    });
});

// Route::group(['middleware' => 'auth:web', 'as' => 'warga.'], function () {
//     Route::view('/wargak', 'wargaa')->name('wargaa');

//     Route::group(['namespace' => 'WargaRT'], function () {
//         Route::group([
//             'prefix' => '/warga', 'as' => 'warga', 'namespace' => 'Warga',
//             'middleware' => ['auth', 'warga']
//         ], function () {
//             Route::resource('wargak', 'WargaController');
//             Route::get('/hj', [WargaController::class, 'hj']);
//         });
//     });
// });





//coba

// Route::group(['namespace' => 'User'], function () {


// Route::group([
//     'prefix' => '/petugas', 'as' => 'petugas', 'namespace' => 'PetugasIuran',
//     'middleware' => ['auth', 'petugas']
// ], function () {
//     Route::resource('petugas', 'PetugasController');
// });

// Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga'], function () {
//     Route::get('/update/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
//     Route::resource('bayar-iuranwajib', 'KeluargaaController');
//     Route::resource('warga', 'WargaController');
// });

// Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT'], function () {
//     Route::resource('kas-iuranwajib', 'KasIuranWajibController');
//     Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
//     Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
//     Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
// });


// Route::group([
//     'prefix' => '/warga', 'as' => 'warga', 'namespace' => 'Warga',
//     'middleware' => ['auth', 'warga']
// ], function () {
//     Route::resource('warga', 'WargaController');
// });

// Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga'], function () {
//     Route::get('/update/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
//     Route::resource('bayar-iuranwajib', 'KeluargaaController');
//     Route::resource('warga', 'WargaController');
// });

// Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT'], function () {
//     Route::resource('kas-iuranwajib', 'KasIuranWajibController');
//     Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
//     Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
//     Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
// });

// });
// });


require __DIR__ . '/demo.php';
