<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
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
    }
}
