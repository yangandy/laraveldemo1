<?php

namespace App\Providers;

use App\Service\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
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
        $this->app->singleton('product',function(){
           return new ProductService();
        });
        $this->app->bind('App\Service\ProductService',function(){
            return new ProductService();
        });
    }
}
