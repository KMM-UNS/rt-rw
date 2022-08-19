<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RekapIuran\RekapIuranAgendaController;

Route::get('/', function () {
    return redirect(route('home'));
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');


    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard.index'));
        });

        // Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
        Route::resource('/dashboard', 'DashboardController');


        Route::resource('/admin', 'AdminController');
        Route::resource('/user', 'UserController');

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            Route::resource('agama', 'AgamaController');
            Route::resource('pekerjaan', 'PekerjaanController');
            Route::resource('status-kawin', 'StatusKawinController');
            Route::resource('pendidikan', 'PendidikanController');
            Route::resource('iuran-wajib', 'IuranWajibController');
            Route::resource('iuran-sukarela', 'IuranSukarelaController');
            Route::resource('iuran-kondisional', 'IuranKondisionalController');
            Route::resource('iuran-agenda', 'IuranAgendaController');
            Route::resource('petugas-tagihan', 'PetugasTagihanController');
            Route::resource('pos', 'PosController');
        });

        Route::group(['prefix' => '/kas-rt', 'as' => 'kas-rt.', 'namespace' => 'KasRT'], function () {
            Route::resource('kas-iuranwajib', 'KasIuranWajibController');
            Route::resource('kas-iuransukarela', 'KasIuranSukaRelaController');
            Route::resource('kas-iurankondisional', 'KasIuranKondisionalController');
            Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
            Route::resource('iuran-bulanan', 'IuranBulananController');
        });

        Route::group(['prefix' => '/rekap-kas', 'as' => 'rekap-kas.', 'namespace' => 'RekapIuran'], function () {
            //tambahan
            Route::get('/rekap-iuranwajib/cetak_pdf/{jenis_iuran_id}/{start}/{end}', 'RekapIuranWajibController@cetak_pdf');
            Route::get('/rekap-iuransukarela/cetak_pdf/{jenis_iuran_id}/{start}/{end}', 'RekapIuranSukaRelaController@cetak_pdf');
            Route::get('/rekap-iurankondisional/cetak_pdf/{jenis_iuran_id}/{start}/{end}', 'RekapIuranKondisionalController@cetak_pdf');
            Route::get('/rekap-iuranagenda/cetak_pdf/{jenis_iuran_id}/{start}/{end}', 'RekapIuranAgendaController@cetak_pdf');
            //end tambahan
            Route::resource('rekap-iuranwajib', 'RekapIuranWajibController');
            Route::resource('rekap-iuransukarela', 'RekapIuranSukaRelaController');
            Route::resource('rekap-iurankondisional', 'RekapIuranKondisionalController');
            Route::resource('rekap-iuranagenda', 'RekapIuranAgendaController');
        });

        Route::group(['prefix' => '/manajemen-keuangan', 'as' => 'manajemen-keuangan.', 'namespace' => 'ManajemenKeuangan'], function () {
            Route::get('/manajemen-pemasukan/cetak_pdf', 'ManajemenPemasukanController@cetak_pdf');
            Route::get('/manajemen-pengeluaran/cetak_pdf', 'ManajemenPengeluaranController@cetak_pdf');
            Route::resource('manajemen-pemasukan', 'ManajemenPemasukanController');
            Route::resource('manajemen-pengeluaran', 'ManajemenPengeluaranController');
            Route::get('/manajemen-pengeluaran/{id}', 'ManajemenPengeluaranController@destroy');
        });
    });
});
