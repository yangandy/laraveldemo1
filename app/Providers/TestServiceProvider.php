<?php

namespace App\Providers;

use App\Service\TestService;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->singleton('cart',function(){
            return new TestService();
        });

        $this->app->bind('App\Service\TestService',function(){

            return new TestService();
        });
    }
}
