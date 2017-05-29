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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/page/{url}', ['as'=>'page', 'uses'=>'PageController@page']);
Route::get('/item/list', ['as'=>'listItem', 'uses'=>'ItemController@listItem']);

Route::get('/item/list/sort/{order}', ['as'=>'listItemSort', 'uses'=>'ItemController@listItem']);
Route::get('/item/{id}', ['as'=>'item', 'uses'=>'ItemController@item']);

Route::post('/select', ['as'=>'select', 'uses'=>'PriceController@select']);

