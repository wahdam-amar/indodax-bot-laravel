<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IndodaxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('idx', function () {

            return new \App\Services\Indodax();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
