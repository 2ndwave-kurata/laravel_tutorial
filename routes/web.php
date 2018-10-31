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

//ログインしていないと出来ないようにするルーティング
Route::group(['middleware' => 'auth'], function() {
    Route::resource('posts','PostsController', ['only' => ['create','store','edit','update','destroy']]);
    Route::post('/comment','PostsController@comment');
  });

  //ログインしていなくても出来ること。
Route::resource('posts','PostsController',['only' => ['index','show']]);

//ログインのルーティング
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');