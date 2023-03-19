<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    //return view('welcome');
    echo "<h1> Hola Mundo </h1>";
});

/*
GET : Conseguir datos
POST : Guardar datos
PUT: Actualizar recursos
DELETE: Eliminar recursos  
*/



// RUTAS DEL API
    //Rutas de prueba
    // Route::get('/usuario/pruebas', 'App\Http\Controllers\UserController@pruebas');
    // Route::get('/categoria/pruebas', 'App\Http\Controllers\CategoryController@pruebas');
    // Route::get('/entrada/pruebas', 'App\Http\Controllers\PostController@pruebas');

    // Rutas del controlador de usuario
    Route::post('api/register', 'App\Http\Controllers\UserController@register');
    Route::post('api/login', 'App\Http\Controllers\UserController@login');
    Route::put('api/user/update', 'App\Http\Controllers\UserController@update');
    Route::post('api/user/upload', 'App\Http\Controllers\UserController@upload')->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
    Route::get('api/user/avatar/{filename}', 'App\Http\Controllers\UserController@getImage');
    Route::get('api/user/detail/{id}', 'App\Http\Controllers\UserController@detail');

    // Rutas del controlador de categoria
    Route::resource('api/category', 'App\Http\Controllers\CategoryController');

    // Rutas del controlador de post (entradas)
    Route::resource('api/post', 'App\Http\Controllers\PostController');
