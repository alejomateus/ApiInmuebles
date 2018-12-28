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
Route::group([ 'middleware' => ['cors']], function ($ruta){
    $ruta->get('/api/cities',  'CiudadController@index');
    $ruta->post('/api/cities',  'CiudadController@store');
    $ruta->get('/api/inmuebles',  'InmuebleController@index');
    $ruta->post('/api/inmuebles',  'InmuebleController@store');

});