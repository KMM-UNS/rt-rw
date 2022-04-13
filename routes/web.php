<?php

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

Route::get('/token', function () {
    return csrf_token();
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');

    Route::group(['namespace' => 'User', 'middleware' => 'auth:web'], function () {
        Route::get('', 'DashboardController@index');
        Route::resource('/keluarga', 'KeluargaController');
        Route::resource('/warga', 'WargaController');

    });
});



require __DIR__ . '/demo.php';
