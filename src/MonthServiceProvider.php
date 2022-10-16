<?php

namespace Cocom\Month;

use Illuminate\Support\ServiceProvider;

class MonthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/Month.php' => config_path('Month.php'),
            ], 'config');
        }
    }
}
