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

Route::get('/', 'VagasController@index');
Route::get('/vaga/{vaga}/{id}', 'VagasController@vaga');
Route::get('/vagas', 'VagasController@show_vagas');
Route::get('/cidades/{id}', 'CidadesController@get_cidades');
Route::get('/search', "VagasController@search");
