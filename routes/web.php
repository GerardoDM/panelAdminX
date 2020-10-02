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

Route::get('/', function () {
    return view('welcome');
});


Route::get('index', function () {
    return view('prueba');
});

Route::get('form', function () {
    return view('form');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('usuario')
    ->as('usuario.')
    ->group(function() {
                
        Route::get('home', 'Home\UsuariosHomeController@index')->name('home')->middleware('auth:usuario');
        

Route::namespace('Auth\Login')
      ->group(function() {
            Route::get('login', 'UsuariosLoginController@showLoginForm')->name('login');
            Route::post('login', 'UsuariosLoginController@login')->name('login');
            Route::post('logout', 'UsuariosLoginController@logout')->name('logout');
      });
 });