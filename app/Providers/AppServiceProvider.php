<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('admin', function () {
            return auth()->user()->is_role_admin;
        });
        Blade::if('user', function () {
            return auth()->user()->is_role_user;
        });
        Blade::if('higher', function () {
            return auth()->user()->is_role_higher_up;
        });
        Blade::if('sdm', function () {
            return auth()->user()->is_role_sdm;
        });
        Blade::if('coordinator', function () {
            return auth()->user()->is_role_coordinator;
        });
        Blade::if('driver', function () {
            return auth()->user()->is_role_driver;
        });
        
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
    }
}
