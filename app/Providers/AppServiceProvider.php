<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    //if it is only for register things, it will only be loaded when its requested, thats what defer means
    //protected $defer=true;
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //A service providers tells how to build something or where to get it
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        //cuando se cargue la vista layouts.sidebar
        view()->composer('layouts.sidebar',function($view){

            //se le coloca la variablearchivos a la vista
            $view->with('archives',\App\Post::archives()); 
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Stripe::class,function(/*$app*/){
            //$app->make()
            return new Stripe(config('services.stripe.secret'));
        });

    }
}
