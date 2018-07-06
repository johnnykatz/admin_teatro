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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index', ['middleware' => ['auth']]);


Route::get('admin/users', ['as' => 'admin.users.index', 'uses' => 'Admin\UserController@index', 'middleware' => ['auth']]);
Route::post('admin/users', ['as' => 'admin.users.store', 'uses' => 'Admin\UserController@store', 'middleware' => ['auth']]);
Route::get('admin/users/create', ['as' => 'admin.users.create', 'uses' => 'Admin\UserController@create', 'middleware' => ['auth']]);
Route::put('admin/users/{users}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update', 'middleware' => ['auth']]);
Route::patch('admin/users/{users}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update', 'middleware' => ['auth']]);
Route::delete('admin/users/{users}', ['as' => 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy', 'middleware' => ['auth']]);
Route::get('admin/users/{users}', ['as' => 'admin.users.show', 'uses' => 'Admin\UserController@show', 'middleware' => ['auth']]);
Route::get('admin/users/{users}/edit', ['as' => 'admin.users.edit', 'uses' => 'Admin\UserController@edit', 'middleware' => ['auth']]);


Route::get('admin/reservas', ['as' => 'admin.reservas.index', 'uses' => 'Admin\ReservaController@index', 'middleware' => ['auth']]);
Route::post('admin/reservas', ['as' => 'admin.reservas.store', 'uses' => 'Admin\ReservaController@store', 'middleware' => ['auth']]);
Route::get('admin/reservas/create', ['as' => 'admin.reservas.create', 'uses' => 'Admin\ReservaController@create', 'middleware' => ['auth']]);
Route::put('admin/reservas/{reservas}', ['as' => 'admin.reservas.update', 'uses' => 'Admin\ReservaController@update', 'middleware' => ['auth']]);
Route::patch('admin/reservas/{reservas}', ['as' => 'admin.reservas.update', 'uses' => 'Admin\ReservaController@update', 'middleware' => ['auth']]);
Route::delete('admin/reservas/{reservas}', ['as' => 'admin.reservas.destroy', 'uses' => 'Admin\ReservaController@destroy', 'middleware' => ['auth']]);
Route::get('admin/reservas/{reservas}', ['as' => 'admin.reservas.show', 'uses' => 'Admin\ReservaController@show', 'middleware' => ['auth']]);
Route::get('admin/reservas/{reservas}/edit', ['as' => 'admin.reservas.edit', 'uses' => 'Admin\ReservaController@edit', 'middleware' => ['auth']]);


Route::get('admin/butacas', ['as' => 'admin.butacas.index', 'uses' => 'Admin\ButacaController@index', 'middleware' => ['auth']]);
Route::post('admin/butacas', ['as' => 'admin.butacas.store', 'uses' => 'Admin\ButacaController@store', 'middleware' => ['auth']]);
Route::get('admin/butacas/create', ['as' => 'admin.butacas.create', 'uses' => 'Admin\ButacaController@create', 'middleware' => ['auth']]);
Route::put('admin/butacas/{butacas}', ['as' => 'admin.butacas.update', 'uses' => 'Admin\ButacaController@update', 'middleware' => ['auth']]);
Route::patch('admin/butacas/{butacas}', ['as' => 'admin.butacas.update', 'uses' => 'Admin\ButacaController@update', 'middleware' => ['auth']]);
Route::delete('admin/butacas/{butacas}', ['as' => 'admin.butacas.destroy', 'uses' => 'Admin\ButacaController@destroy', 'middleware' => ['auth']]);
Route::get('admin/butacas/{butacas}', ['as' => 'admin.butacas.show', 'uses' => 'Admin\ButacaController@show', 'middleware' => ['auth']]);
Route::get('admin/butacas/{butacas}/edit', ['as' => 'admin.butacas.edit', 'uses' => 'Admin\ButacaController@edit', 'middleware' => ['auth']]);
Route::get('admin/butacas/ajax/getButacasLibresAjax', ['as' => 'admin.butacas.getButacasLibresAjax', 'uses' => 'Admin\ButacaController@getButacasLibresAjax', 'middleware' => ['auth']]);
