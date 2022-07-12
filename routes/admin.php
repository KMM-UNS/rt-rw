<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RekapIuran\RekapIuranAgendaController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');


    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard.index'));
        });

        // Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
        Route::resource('/dashboard', 'DashboardController');

        // Route::resource('/mahasiswa', 'MahasiswaController');
        // Route::get('/pages/user/mahasiswa/edit/{mahasiswa}', 'MahasiswaController@edit');

        // Route::resource('info', 'InfoController');
        // Route::resource('prodi', 'ProdiController');
        // Route::resource('status', 'StatusController');

        Route::resource('/admin', 'AdminController');
        Route::resource('/user', 'UserController');
        // Route::resource('/orang-hilang', 'OrangHilangController');
        // Route::group(['prefix' => '/kehilangan', 'as' => 'kehilangan.'], function () {
        //     Route::get('/lampiran-dokumen', 'KehilanganBarangController@getLampiranDokumen')->name('lampiran-dokumen');
        //     Route::resource('/', 'KehilanganBarangController')->parameter('', 'kehilangan');
        // });

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            Route::resource('agama', 'AgamaController');
            // Route::resource('fakultas', 'FakultasController');
            // Route::resource('slider', 'SliderController');
            // Route::resource('tahun', 'TahunController');
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
            // Route::get('/updateagenda/status/{id}', 'KasIuranAgendaController@status')->name('kas-iuranagenda.status');
            Route::resource('kas-iuranagenda', 'KasIuranAgendaController');
            Route::resource('iuran-bulanan', 'IuranBulananController');
        });

        Route::group(['prefix' => '/rekap-kas', 'as' => 'rekap-kas.', 'namespace' => 'RekapIuran'], function () {
            // Route::get('/rekap-iuranagenda/cetak-data-pertanggal/{tglawal}/{tglakhir}/cetak_pdf', 'RekapIuranAgendaController@cetak_pdf')->name('cetak-rekapagenda_pdf');
            // Route::get('/rekap-iuranagenda/cetak-data-pertanggal/{tglawal}/{tglakhir}', 'RekapIuranAgendaController@cetakRekapAgendaPertanggal')->name('cetak-data-pertanggal');
            //tambahan
            // Route::get('/laporankematian', 'RekapIuranSukaRelaController@laporankematian')->name('laporankematian');
            // Route::post('/laporankematian', 'RekapIuranSukaRelaController@sortir');
            // Route::get('/cetaklaporankematian/{start}/{end}', 'RekapIuranSukaRelaController@cetakLaporanKematian');
            // Route::get('/laporankematian', 'RekapIuranAgendaController@laporankematian')->name('laporankematian');
            // Route::post('/laporankematian', 'RekapIuranAgendaController@sortir');
            // Route::get('/rekap-iuranagenda/periode', 'RekapIuranAgendaController@periode');
            // Route::get('/rekap-iuranagenda/{tglawal}/{tglakhir}', 'RekapIuranAgendaController@cetak_pdf');
            Route::get('/rekap-iuranagenda/cetak_pdf', 'RekapIuranAgendaController@cetak_pdf');
            // Route::get('/rekap-iuranagenda/cetak_pdf', 'RekapIuranAgendaController@cetak_pdf');
            //end tambahan
            Route::resource('rekap-iuranwajib', 'RekapIuranWajibController');
            Route::resource('rekap-iuransukarela', 'RekapIuranSukaRelaController');
            Route::resource('rekap-iurankondisional', 'RekapIuranKondisionalController');
            Route::resource('rekap-iuranagenda', 'RekapIuranAgendaController');
            Route::post('/rekap-iuranwajib/cetak_pdf', 'RekapIuranWajibController@cetak_pdf')->name('rekap-iuranwajib.cetak');

            // Route::get('exportrekapiuranwajib', 'RekapIuranWajibController@rekapiuranwajibexport');
            // Route::get('export-rekapwajib', 'RekapIuranWajibController@export_rekapwajib');
            // Route::get('coba', 'RekapIuranAgendaController@coba');
        });

        Route::group(['prefix' => '/manajemen-keuangan', 'as' => 'manajemen-keuangan.', 'namespace' => 'ManajemenKeuangan'], function () {
            Route::get('/manajemen-pemasukan/cetak_pdf', 'ManajemenPemasukanController@cetak_pdf');
            Route::get('/manajemen-pengeluaran/cetak_pdf', 'ManajemenPengeluaranController@cetak_pdf');
            Route::resource('manajemen-pemasukan', 'ManajemenPemasukanController');
            Route::resource('manajemen-pengeluaran', 'ManajemenPengeluaranController');
            Route::get('/manajemen-pengeluaran/{id}', 'ManajemenPengeluaranController@destroy');
        });

        // Route::get('export-rekapwajib', 'RekapIuranWajibController@export_rekapwajib');
        // tambahan
        // Route::resource('/gelombang', 'GelombangController');
        // Route::resource('/pendaftar', 'PendaftarController');
    });
});
