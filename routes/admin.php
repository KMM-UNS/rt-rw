<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');


    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });

        Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');


        Route::resource('/mahasiswa', 'MahasiswaController');
        Route::get('/pages/user/mahasiswa/edit/{mahasiswa}', 'MahasiswaController@edit');

        Route::resource('info', 'InfoController'); 
        Route::resource('prodi', 'ProdiController'); 
        Route::resource('status', 'StatusController');

        Route::resource('/admin', 'AdminController');
        Route::resource('/user', 'UserController');
        Route::resource('/orang-hilang', 'OrangHilangController');
        Route::group(['prefix' => '/kehilangan', 'as' => 'kehilangan.'], function () {
            Route::get('/lampiran-dokumen', 'KehilanganBarangController@getLampiranDokumen')->name('lampiran-dokumen');
            Route::resource('/', 'KehilanganBarangController')->parameter('', 'kehilangan');
        });

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            Route::resource('agama', 'AgamaController');
            Route::resource('fakultas', 'FakultasController');
            Route::resource('slider', 'SliderController');
            // Route::get('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload');
            // Route::post('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload.post');
            Route::resource('tahun', 'TahunController');
            Route::resource('pekerjaan', 'PekerjaanController');
            Route::resource('status-kawin', 'StatusKawinController');
            Route::resource('pendidikan', 'PendidikanController');

 
        });

        // tambahan
        Route::resource('/gelombang', 'GelombangController');
        Route::resource('/pendaftar', 'PendaftarController');
    });
});
