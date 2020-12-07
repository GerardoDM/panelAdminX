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

Route::get('bloqueDetalle/{clave}', 'BloqueController@viewDetail');
Route::get('cursoDetalle/{clave}', 'CursoController@viewDetail');
Route::get('productoDetalle/{clave}', 'ProductoController@viewDetail');
Route::get('proyectoDetalle/{clave}', 'ProyectoController@viewDetail');
Route::get('pivotDetalle/{clave}', 'PivotController@viewDetail');
Route::get('productoCursoDetalle/{clave}/{claveDos}', 'ProductoCursoController@viewDetail');


Route::group(['middleware' => 'auth'], function () {
        Route::get('productos', 'ProductoController@view');
        Route::get('proyectos', 'ProyectoController@view');
        Route::get('pivot', 'PivotController@view');
        Route::get('bloques', 'BloqueController@view');
        Route::get('cursos', 'CursoController@view');
        Route::get('pivotProductoCurso', 'ProductoCursoController@view');
        Route::get('/', 'DashController@view')->name('/');
  });

// Auth::routes(['register' => false]);
// Auth::routes(['login' => false]);

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