<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RekapIuran\RekapIuranAgendaController;
use Illuminate\Routing\RouteRegistrar;

Route::get('/', function () {
    return redirect(route('home'));
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // require base_path('vendor/laravel/fortify/routes/routes.php');

    Route::group(['namespace' => 'Admin', 'middleware' => ['role:admin|ketua_rt|bendahara']], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard.index'));
        });

        // Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
        Route::resource('/dashboard', 'DashboardController');

        Route::resource('/users', 'UserController')->middleware('role:admin');
        Route::resource('/settings', 'SettingController');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Route::resource('/admin', 'AdminController');
        // Route::resource('/user', 'UserController');
        Route::resource('/kritik-saran', 'KritikSaranController');

        Route::group(['prefix' => '/surat', 'as' => 'surat.'], function () {
            Route::get('/cetak/{id}', 'SuratController@cetak')->name('cetak');
            Route::resource('/', 'SuratController')->parameter('', 'surat');
            Route::post('verifikasi/{id}', 'SuratController@verifikasi')->name('verifikasi');
            Route::post('tolak/{id}', 'SuratController@tolak')->name('tolak');
        });
        Route::resource('rumah', 'RumahController');
        Route::resource('tamu', 'TamuController');
        Route::group(['prefix' => '/warga', 'as' => 'warga.'], function () {
            Route::resource('/pindah', 'WargaPindahController');
            Route::resource('/meninggal', 'WargaMeninggalController');
            Route::resource('/', 'WargaController')->parameter('', 'warga');
        });
        Route::group(['prefix' => '/keluarga', 'as' => 'keluarga.'], function () {
            Route::resource('/', 'KeluargaController')->parameter('','keluarga');
            Route::post('pindah/{id}', 'KeluargaController@pindah')->name('pindah');
            Route::post('verifikasi/{id}', 'KeluargaController@verifikasi')->name('verifikasi');
            Route::post('tolak/{id}', 'KeluargaController@tolak')->name('tolak');
        });

        Route::group(['prefix' => '/ronda', 'as' => 'ronda.'], function () {
            Route::resource('/jadwal', 'JadwalRondaController');
            Route::resource('/presensi', 'PresensiRondaController');
        });

        Route::resource('aplikasi', 'AppController');
        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master', 'middleware' => ['role:admin'] ], function () {
            Route::resource('agama', 'AgamaController');
            Route::resource('pekerjaan', 'PekerjaanController');
            Route::resource('status-kawin', 'StatusKawinController');
            Route::resource('pendidikan', 'PendidikanController');
            Route::group(['prefix' => '/ronda', 'as' => 'ronda.'], function () {
                Route::get('aktif/{id}', 'RondaController@aktif')->name('aktif');
                Route::resource('/', 'RondaController')->parameter('', 'ronda');
            });
            Route::resource('golongan-darah', 'GolonganDarahController');
            Route::resource('keperluan-surat', 'KeperluanSuratController');
            Route::resource('status-keluarga', 'StatusKeluargaController');
            Route::resource('status-warga', 'StatusWargaController');
            Route::resource('status-penggunaan-rumah', 'StatusPenggunaanRumahController');
            Route::resource('status-hunian', 'StatusHunianController');
            Route::resource('status-tinggal', 'StatusTinggalController');
            Route::resource('warga-negara', 'WargaNegaraController');

        });

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master', 'middleware' => ['role:admin|bendahara']], function () {
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
