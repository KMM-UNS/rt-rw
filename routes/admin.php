<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');


    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::resource('/admin', 'AdminController');
        Route::resource('/user', 'UserController');

        Route::group(['prefix' => '/surat', 'as' => 'surat.'], function () {
            Route::get('/cetak/{id}', 'SuratController@cetak')->name('cetak');
            Route::resource('/', 'SuratController');
            Route::post('verifikasi/{id}', 'SuratController@verifikasi')->name('verifikasi');
        });
        Route::resource('rumah', 'RumahController');
        Route::resource('warga', 'WargaController');
        Route::group(['prefix' => '/keluarga', 'as' => 'keluarga.'], function () {
            Route::resource('/', 'KeluargaController');
            Route::post('pindah/{id}', 'KeluargaController@pindah')->name('pindah');
        });

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            Route::resource('agama', 'AgamaController');
            Route::resource('pekerjaan', 'PekerjaanController');
            Route::resource('status-kawin', 'StatusKawinController');
            Route::resource('pendidikan', 'PendidikanController');
            Route::resource('golongan-darah', 'GolonganDarahController');
            Route::resource('keperluan-surat', 'KeperluanSuratController');
            Route::resource('jenis-surat-keterangan', 'JenisSuratKeteranganController');
            Route::resource('status-keluarga', 'StatusKeluargaController');
            Route::resource('status-warga', 'StatusWargaController');
            Route::resource('status-penggunaan-rumah', 'StatusPenggunaanRumahController');
            Route::resource('status-hunian', 'StatusHunianController');
            Route::resource('status-tinggal', 'StatusTinggalController');
            Route::resource('warga-negara', 'WargaNegaraController');
        });
    });
});
