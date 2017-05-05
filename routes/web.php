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

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
	Route::any('board', 'HomeController@board');
	Route::get('get_my_board', 'HomeController@get_my_board');
	Route::get('board/{id}', 'BoardController@show');
	Route::post('board/add_list', 'BoardController@add_list');
});