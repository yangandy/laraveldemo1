<?php

namespace App\Providers;

use App\Service\OrderBackService;
use Illuminate\Support\ServiceProvider;

class OrderBackServiceProvider extends ServiceProvider
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
        $this->app->singleton('orderback',function(){
           return new OrderBackService();
        });
        $this->app->bind('App\Service\OrderBackService',function(){
            return new OrderBackService();

        });

    }

}
