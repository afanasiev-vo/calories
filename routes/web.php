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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/ingredient', 'IngredientController@index');
Route::post('/ingredient', 'IngredientController@store');
Route::delete('/ingredient/{id}', 'IngredientController@destroy');

Route::post('/file-upload', 'FileController@upload');

Route::get('/receipts', 'ProductController@page');
Route::get('/products', 'ProductController@index');
Route::post('/products', 'ProductController@store');

Route::get('/eats', 'EatController@index');
