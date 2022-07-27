<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\User\KeluargaController;
use App\Models\Keluarga;
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
        Route::resource('/tamu', 'TamuController');
        Route::resource('/warga', 'WargaController');

    });
});


require __DIR__ . '/demo.php';
