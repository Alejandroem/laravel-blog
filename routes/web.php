<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Wher should registrations like these should be placed?
//App::singleton builds up an instance that it's not diffrent no mater how many times it's builted
App::bind('App\Billing\Stripe',function(){
    return new \App\Billing\Stripe(config('services.stripe.secret'));
});

//Switch the current instance with other one
//App::instance('App\Billing\Stripe',$stripe);

//$stripe = App::make('App\Billing\Stripe'); exact same thing that below
//$stripe = resolve('App\Billing\Stripe');
$stripe = app('App\Billing\Stripe');
dd($stripe);
*/

Route::get('/','PostsController@index')->name('home');
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store');
Route::get('/posts/{post}','PostsController@show');

Route::post('/posts/{post}/comments','CommentsController@store');


Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');

Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');

Route::get('/logout','SessionsController@destroy');

