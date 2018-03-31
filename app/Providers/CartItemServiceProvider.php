<?php

namespace App\Providers;

use App\Service\CartItemService;
use Illuminate\Support\ServiceProvider;

class CartItemServiceProvider extends ServiceProvider
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
           return new CartItemService();
        });


        $this->app->bind('App\Service\CartItemService',function(){
           return new CartItemService();
        });
    }
}
