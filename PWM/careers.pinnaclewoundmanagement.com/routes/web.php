<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\WelcomeController@index');

Route::get('/open-positions/{slug}', 'App\Http\Controllers\PostController@show');

//Route::post('/apply/{slug}', 'App\Http\Controllers\ApplicantController@create');

Route::post("/post/saveapplicant", "App\Http\Controllers\ApplicantController@create");
