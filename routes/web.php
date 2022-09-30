<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\User\KeluargaController;
use App\Models\Keluarga;
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


Route::get('', function () {
    return redirect(route('beranda.index'));
});

Route::get('admin', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('/token', function () {
    return csrf_token();
});

Route::resource('beranda', 'BerandaController');
Route::get('/edit-profile', 'ProfileController@edit')->name('edit-profile');


Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');
    Route::group(['namespace' => 'User', 'middleware' => 'auth:web'], function () {
        Route::get('/', function () {
            return redirect(route('user.dashboard'));
        });
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('/keluarga', 'KeluargaController');
        Route::group(['prefix' => '/surat', 'as' => 'surat.'], function () {
            Route::get('/cetak/{id}', 'SuratController@cetak')->name('cetak');
            Route::resource('/', 'SuratController')->parameter('','surat');
        });
        Route::resource('/ronda', 'PresensiRondaController');
        Route::resource('/tamu', 'TamuController');
        Route::resource('/warga', 'WargaController');

        Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
            Route::get('/cetak_pdf_wajib/{jenis_iuran_id}', 'KasController@cetak_pdf_wajib')->name('cetak_pdf_wajib');
            Route::get('/cetak_pdf_sukarela/{jenis_iuran_id}', 'KasController@cetak_pdf_sukarela')->name('cetak_pdf_sukarela');
            Route::get('/cetak_pdf_kondisional/{jenis_iuran_id}', 'KasController@cetak_pdf_kondisional')->name('cetak_pdf_kondisional');
            Route::get('/cetak_pdf_agenda/{jenis_iuran_id}', 'KasController@cetak_pdf_agenda')->name('cetak_pdf_agenda');
            Route::resource('/', 'KasController')->parameter('','kas');
        });

        Route::group([
            'prefix' => '/petugas-iuran', 'as' => 'petugas-iuran.', 'namespace' => 'PetugasIuran',
            'middleware' => ['role:petugas_iuran']
        ], function () {
            // Route::resource('petugas', 'PetugasController');
            Route::resource('data-petugas', 'PetugasController');
        });

        Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga', 'middleware' => ['role:petugas_iuran']], function () {
            Route::get('/updatewajib/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
            Route::get('/updatesukarela/status/{id}', 'BayarSukarelaController@status')->name('bayar-iuransukarela.status');
            Route::get('/updatekondisional/status/{id}', 'BayarKondisionalController@status')->name('bayar-iurankondisional.status');
            Route::get('/updateagenda/status/{id}', 'BayarAgendaController@status')->name('bayar-iuranagenda.status');
            Route::get('bayar-iuranwajib/cetak_iuran_sosial/{bulan}/{tahun}', 'BayarWajibController@cetak_sosial')->name('cetak_sosial');
            Route::get('bayar-iuranwajib/cetak_iuran_kebersihan/{bulan}/{tahun}', 'BayarWajibController@cetak_kebersihan')->name('cetak_kebersihan');
            Route::get('bayar-iuransukarela/cetak_iuran_pendidikan/{bulan}/{tahun}', 'BayarSukarelaController@cetak_pendidikan')->name('cetak_pendidikan');
            Route::get('bayar-iuransukarela/cetak_iuran_arisan/{bulan}/{tahun}', 'BayarSukarelaController@cetak_arisan')->name('cetak_arisan');
            Route::get('bayar-iurankondisional/cetak_iuran_dendaronda/{bulan}/{tahun}', 'BayarKondisionalController@cetak_dendaronda')->name('cetak_dendaronda');
            Route::get('bayar-iuranagenda/cetak_iuran_halal/{bulan}/{tahun}', 'BayarAgendaController@cetak_halal')->name('cetak_halal');
            Route::get('bayar-iuranagenda/cetak_iuran_hut/{bulan}/{tahun}', 'BayarAgendaController@cetak_hut')->name('cetak_hut');
            Route::get('bayar-iuranwajib/detail', 'BayarWajibController@detaill')->name('detail_wajib');
            Route::resource('bayar-iuranwajib', 'BayarWajibController');
            Route::resource('bayar-iuransukarela', 'BayarSukarelaController');
            Route::resource('bayar-iurankondisional', 'BayarKondisionalController');
            Route::resource('bayar-iuranagenda', 'BayarAgendaController');
            Route::resource('warga', 'WargaController');
        });

        Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT', 'middleware' => ['role:petugas_iuran']], function () {
            Route::get('/kas-iuranwajib/cetak_pdf/{id}', 'KasIuranWajibController@cetak_pdf')->name('cetak_pdf_wajib');
            Route::get('/kas-iurasukarela/cetak_pdf/{id}', 'KasIuranSukaRelaController@cetak_pdf')->name('cetak_pdf_sukarela');
            Route::get('/kas-iurankondisional/cetak_pdf/{id}', 'KasIuranKondisionalController@cetak_pdf')->name('cetak_pdf_kondisional');
            Route::get('/kas-iuranagenda/cetak_pdf/{id}', 'KasIuranAgendaController@cetak_pdf')->name('cetak_pdf_agenda');
            Route::resource('kas-iuranwajib', 'KasIuranWajibController');
            Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
            Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
            Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
        });

    });
});

// Route::view('/', 'home')->name('home');
//versi asli


// Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {
//     // Route::view('/home', 'homekedua')->name('homekedua');

//     Route::group(['namespace' => 'User'], function () {
//         Route::group([
//             'prefix' => '/petugas-iuran', 'as' => 'petugas-iuran.', 'namespace' => 'PetugasIuran',
//             'middleware' => ['role:petugas_iuran']
//         ], function () {
//             // Route::resource('petugas', 'PetugasController');
//             Route::resource('data-petugas', 'PetugasController');
//         });

//         Route::group(['prefix' => '/kepala-keluarga', 'as' => 'kepala-keluarga.', 'namespace' => 'KepalaKeluarga', 'middleware' => ['role:petugas_iuran']], function () {
//             Route::get('/updatewajib/status/{id}', 'KeluargaaController@status')->name('bayar-iuranwajib.status');
//             Route::get('/updatesukarela/status/{id}', 'BayarSukarelaController@status')->name('bayar-iuransukarela.status');
//             Route::get('/updatekondisional/status/{id}', 'BayarKondisionalController@status')->name('bayar-iurankondisional.status');
//             Route::get('/updateagenda/status/{id}', 'BayarAgendaController@status')->name('bayar-iuranagenda.status');
//             Route::get('bayar-iuranwajib/cetak_iuran_sosial/{bulan}/{tahun}', 'BayarWajibController@cetak_sosial')->name('cetak_sosial');
//             Route::get('bayar-iuranwajib/cetak_iuran_kebersihan/{bulan}/{tahun}', 'BayarWajibController@cetak_kebersihan')->name('cetak_kebersihan');
//             Route::get('bayar-iuransukarela/cetak_iuran_pendidikan/{bulan}/{tahun}', 'BayarSukarelaController@cetak_pendidikan')->name('cetak_pendidikan');
//             Route::get('bayar-iuransukarela/cetak_iuran_arisan/{bulan}/{tahun}', 'BayarSukarelaController@cetak_arisan')->name('cetak_arisan');
//             Route::get('bayar-iurankondisional/cetak_iuran_dendaronda/{bulan}/{tahun}', 'BayarKondisionalController@cetak_dendaronda')->name('cetak_dendaronda');
//             Route::get('bayar-iuranagenda/cetak_iuran_halal/{bulan}/{tahun}', 'BayarAgendaController@cetak_halal')->name('cetak_halal');
//             Route::get('bayar-iuranagenda/cetak_iuran_hut/{bulan}/{tahun}', 'BayarAgendaController@cetak_hut')->name('cetak_hut');
//             Route::get('bayar-iuranwajib/detail', 'BayarWajibController@detaill')->name('detail_wajib');
//             Route::resource('bayar-iuranwajib', 'BayarWajibController');
//             Route::resource('bayar-iuransukarela', 'BayarSukarelaController');
//             Route::resource('bayar-iurankondisional', 'BayarKondisionalController');
//             Route::resource('bayar-iuranagenda', 'BayarAgendaController');
//             Route::resource('warga', 'WargaController');
//             // Route::get('/wargak/status', 'WargaController@wargah');
//             // Route::resource('wargak', 'WargaController');
//             // Route::view('/wargak', 'wargaa')->name('wargaa');
//         });

//         Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT', 'middleware' => ['role:petugas_iuran']], function () {
//             Route::get('/kas-iuranwajib/cetak_pdf/{id}', 'KasIuranWajibController@cetak_pdf')->name('cetak_pdf_wajib');
//             Route::get('/kas-iurasukarela/cetak_pdf/{id}', 'KasIuranSukaRelaController@cetak_pdf')->name('cetak_pdf_sukarela');
//             Route::get('/kas-iurankondisional/cetak_pdf/{id}', 'KasIuranKondisionalController@cetak_pdf')->name('cetak_pdf_kondisional');
//             Route::get('/kas-iuranagenda/cetak_pdf/{id}', 'KasIuranAgendaController@cetak_pdf')->name('cetak_pdf_agenda');
//             Route::resource('kas-iuranwajib', 'KasIuranWajibController');
//             Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
//             Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
//             Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
//         });

//         Route::group(['prefix' => '/warga', 'as' => 'warga.', 'namespace' => 'StatusIuranWarga', 'middleware' => ['auth', 'warga']], function () {
//             // Route::get('/wargak/status', 'WargaController@wargah');
//             // Route::resource('wargak', 'WargaController');
//             Route::get('/wargak/cetak_pdf_wajib/{jenis_iuran_id}', 'WargaController@cetak_pdf_wajib')->name('cetak_pdf_wajib');
//             Route::get('/wargak/cetak_pdf_sukarela/{jenis_iuran_id}', 'WargaController@cetak_pdf_sukarela')->name('cetak_pdf_sukarela');
//             Route::get('/wargak/cetak_pdf_kondisional/{jenis_iuran_id}', 'WargaController@cetak_pdf_kondisional')->name('cetak_pdf_kondisional');
//             Route::get('/wargak/cetak_pdf_agenda/{jenis_iuran_id}', 'WargaController@cetak_pdf_agenda')->name('cetak_pdf_agenda');
//             Route::resource('/wargak', 'WargaController');
//             Route::resource('/data-diri', 'DataWargaController');
//         });
//     });
// });

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/verify', function () {
    return view('auth.verify');
})->name('verify');

Route::post('/register', 'AuthController@create')->name('register');
Route::post('/resend', 'AuthController@resend')->name('resend');
Route::post('/verify', 'AuthController@verify')->name('verify');

require __DIR__ . '/demo.php';
