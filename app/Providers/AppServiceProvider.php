<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);
        // global settings via config
        // config([
        //     'settings' => Setting::all([
        //         'name', 'value'
        //     ])
        //         ->keyBy('name')
        //         ->transform(function ($setting) {
        //             return $setting->value;
        //         })
        //         ->toArray()
        // ]);
    }
}
