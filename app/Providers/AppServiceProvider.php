<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*','App\Http\ViewComposers\CalendarComposer');
        view()->composer('*','App\Http\ViewComposers\PengumumanTA1Composer');
        view()->composer('*','App\Http\ViewComposers\PengumumanTA2Composer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
