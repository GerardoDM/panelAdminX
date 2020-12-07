<?php

use App\Models\Producto;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/usuarios', 'UsuarioController@index');
Route::post('/usuario', 'UsuarioController@create');
Route::delete('/usuario/{clave}', 'UsuarioController@delete');
Route::put('/usuario/{clave}', 'UsuarioController@update');

Route::get('/productos', 'ProductoController@index');
Route::post('/producto', 'ProductoController@create');
Route::delete('/producto/{clave}', 'ProductoController@delete');
Route::put('/producto/{clave}', 'ProductoController@update');
Route::get('/searchProducto', 'ProductoController@search');
Route::get('/showProducto/{clave}', 'ProductoController@show');

Route::get('/proyectos', 'ProyectoController@index');
Route::post('/proyecto', 'ProyectoController@create');
Route::delete('/proyecto/{clave}', 'ProyectoController@delete');
Route::put('/proyecto/{clave}', 'ProyectoController@update');
Route::get('/searchProyecto', 'ProyectoController@search');
Route::get('/showProyecto/{clave}', 'ProyectoController@show');

Route::get('/pivots', 'PivotController@index');
Route::post('/pivot', 'PivotController@create');
Route::delete('/pivot/{clave}', 'PivotController@delete');
Route::put('/pivot/{clave}', 'PivotController@update');
Route::get('/showPivot/{clave}', 'PivotController@show');
Route::get('/showJoin/{clave}', 'PivotController@joinShow');
Route::get('/pivotsJoin', 'PivotController@join');

Route::get('/cursos', 'CursoController@index');
Route::post('/curso', 'CursoController@create');
Route::delete('/curso/{clave}', 'CursoController@delete');
Route::put('/curso/{clave}', 'CursoController@update');
Route::get('/searchCurso', 'CursoController@search');
Route::get('/showCurso/{clave}', 'CursoController@show');

Route::get('/bloques', 'BloqueController@index');
Route::post('/bloque', 'BloqueController@create');
Route::delete('/bloque/{clave}', 'BloqueController@delete');
Route::put('/bloque/{clave}', 'BloqueController@update');
Route::get('/searchBloque', 'BloqueController@search');
Route::get('/showBloque/{clave}', 'BloqueController@show');

Route::get('/pivotProductoCurso', 'ProductoCursoController@index');
Route::delete('/pivotProductoCurso/{cve_curso}/{cve_producto}', 'ProductoCursoController@delete');
Route::put('/pivotProductoCurso/{cve_curso}/{cve_producto}', 'ProductoCursoController@update');
Route::post('/pivotProductoCurso', 'ProductoCursoController@create');
Route::get('/pivotProductoCursoJoin', 'ProductoCursoController@join');
Route::get('/pivotProductoCursoShow/{cve_curso}/{cve_producto}', 'ProductoCursoController@joinShow');

