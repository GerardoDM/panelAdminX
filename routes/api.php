<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', 'UsuarioController@index');
Route::post('/usuarios', 'UsuarioController@create');
Route::delete('/usuarios/{clave}', 'UsuarioController@delete');
Route::put('/usuarios/{clave}', 'UsuarioController@update');

Route::get('/productos', 'ProductoController@index');
Route::post('/productos', 'ProductoController@create');
Route::delete('/productos/{clave}', 'ProductoController@delete');
Route::put('/productos/{clave}', 'ProductoController@update');

Route::get('/proyectos', 'ProyectoController@index');
Route::post('/proyectos', 'ProyectoController@create');
Route::delete('/proyectos/{clave}', 'ProyectoController@delete');
Route::put('/proyectos/{clave}', 'ProyectoController@update');

Route::get('/pivot', 'PivotController@index');
Route::post('/pivot', 'PivotController@create');
Route::delete('/pivot/{clave}', 'PivotController@delete');
Route::put('/pivot/{clave}', 'PivotController@update');

Route::get('/curso', 'CursoController@index');
Route::post('/curso', 'CursoController@create');
Route::delete('/curso/{clave}', 'CursoController@delete');
Route::put('/curso/{clave}', 'CursoController@update');
