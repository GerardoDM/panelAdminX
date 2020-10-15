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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('prueba', function () {
    return view('prueba');
});

Route::get('form', function () {
    return view('form');
});

Route::get('productos', function () {
    return view('pages.productos');
});

Route::get('proyectos', function () {
    return view('pages.proyectos');
});

Route::get('pivot', function () {
    return view('pages.pivot');
});

Route::get('cursos', function () {
    return view('pages.cursos');
});

Route::get('bloques', function () {
    return view('pages.bloques');
});

Route::get('/', function () {
    return view('spa');
});


Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');




//Autenticacion


Route::prefix('usuario')
    ->as('usuario.')
    ->group(function() {
                
        Route::get('home', 'Home\UsuariosHomeController@index')->name('home')->middleware('auth');
       
        

Route::namespace('Auth\Login')
      ->group(function() {
            Route::get('login', 'UsuariosLoginController@showLoginForm')->name('login');
            Route::post('login', 'UsuariosLoginController@login')->name('login');
            Route::post('logout', 'UsuariosLoginController@logout')->name('logout');
      });
 });