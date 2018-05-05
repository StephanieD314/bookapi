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

Route::get('books', 'Api\BookController@index');
Route::post('books', 'Api\BookController@store');
Route::get('books/categories', 'Api\BookController@categories');
Route::post('books/filter', 'Api\BookController@filter');
