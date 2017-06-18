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

//Route::get('/', function () {
  //  return view('home');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('/', ['as'=>'home', 'uses'=>'PageController@home']);
Route::get('/page/{url}', ['as'=>'page', 'uses'=>'PageController@page']);
//Route::get('/item/list', ['as'=>'listItem', 'uses'=>'ItemController@listItem']);

Route::get('/item/list/brand/{brand}/type/{type}', ['as'=>'listItem.brand.type', 'uses'=>'ItemController@ItemBrand']);
Route::get('/item/list/brand/{brand}/type/{type}/{order}', ['as'=>'listItem.brand.type.order', 'uses'=>'ItemController@ItemBrand']);
Route::get('/item/list/brand/{brand}/type/{type}/spring/{spring}', ['as'=>'listItem.brand.type.spring', 'uses'=>'ItemController@itemBrandSpring']);
Route::get('/item/list/brand/{brand}/type/{type}/spring/{spring}/{order}', ['as'=>'listItem.brand.type.spring.order', 'uses'=>'ItemController@itemBrandSpring']);
Route::get('/item/list/brand/{brand}/type/{type}/series/{series}', ['as'=>'listItem.brand.type.series', 'uses'=>'ItemController@itemBrandSeries']);
Route::get('/item/list/brand/{brand}/type/{type}/series/{series}/{order}', ['as'=>'listItem.brand.type.series.order', 'uses'=>'ItemController@itemBrandSeries']);
Route::get('/item/list/type/{type}/spring/{spring}', ['as'=>'listItem.type.spring', 'uses'=>'ItemController@itemSpring']);
Route::get('/item/list/type/{type}/spring/{spring}/{order}', ['as'=>'listItem.type.spring.order', 'uses'=>'ItemController@itemSpring']);
Route::get('/item/list/type/{type}/class/{class}', ['as'=>'listItem.type.class', 'uses'=>'ItemController@itemClass']);
Route::get('/item/list/type/{type}/class/{class}/{order}', ['as'=>'listItem.type.class.order', 'uses'=>'ItemController@itemClass']);
Route::get('/item/list/type/{type}/series/{series}', ['as'=>'listItem.type.series', 'uses'=>'ItemController@itemSeries']);
Route::get('/item/list/type/{type}/series/{series}/{order}', ['as'=>'listItem.type.series.order', 'uses'=>'ItemController@itemSeries']);

//Route::get('/item/list/sort/{order}', ['as'=>'listItemSort', 'uses'=>'ItemController@listItem']);
Route::get('/item/{id}', ['as'=>'item', 'uses'=>'ItemController@item']);
//Route::get('/item/type/2/{id}', ['as'=>'item2', 'uses'=>'ItemController@item2']);

Route::post('/select', ['as'=>'select', 'uses'=>'PriceController@select']);

Route::get('/promotion', ['as'=>'promotion', 'uses'=>'PromotionController@promotions']);

