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


Route::get('/rol','UsuarioController@rol');

Route::get('/clases', function () {
    return view('/principal/clases');
});

Route::post('/login','UsuarioController@Login');

Route::get('/cursos', function () {
    return view('/principal/cursos');
});

/*Route::get('/registrar', function () {
    return view('/principal/registrar');
});*/

Route::get('/login', function () {
    return view('/principal/iniciar_sesion');
});

Route::get('/acerca_de', function () {
    return view('/principal/acerca_de');
});

Route::get('/iniciar_sesion', function () {
    return view('/principal/iniciar_sesion');
});

/*Route::get('/registrar', function () {
    return view('/principal/registrar');
});*/



Route::get('/','RolController@index');
Route::get('/todos','CursosController@cursos');


//Auth::routes();

Route::get('registrar','RolController@registrar');
//Route::get('registrar','RolController@registrar') -> name('registrar');
