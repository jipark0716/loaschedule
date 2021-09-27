<?php

namespace App\Providers;

use Illuminate\Support\{ServiceProvider, Facades\Blade};

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
        if (config('app.ssl')) {
            \URL::forceScheme('https');
        }

        if (request()->ip() == '122.43.5.144') {
            \Config::set('app.debug', true);
        }

        Blade::if('mobile', function () {
            return !!preg_match('/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/', request()->header('User-Agent'));
        });
    }
}
