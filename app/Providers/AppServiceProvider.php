<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Blade::if('global_admin', function () {
            return auth()->user() && auth()->user()->role == 3;
        });
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Baku');
    }
}
