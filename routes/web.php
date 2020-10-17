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
})->middleware('auth');

Route::get('proyectos', function () {
    return view('pages.proyectos');
})->middleware('auth');

Route::get('pivot', function () {
    return view('pages.pivot');
})->middleware('auth');

Route::get('cursos', function () {
    return view('pages.cursos');
})->middleware('auth');

Route::get('bloques', function () {
    return view('pages.bloques');
})->middleware('auth');

Route::get('/', function () {
    return view('spa');
})->middleware('auth');


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
            Route::post('logout', 'UsuariosLoginController@logout')->name('logout')->middleware('web');
      });
 });