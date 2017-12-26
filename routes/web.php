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

/*
 * Admin
 */
Route::group(['prefix' => 'admin'], function () {
	//Login - Logout
	Route::get('login','Admin\AuthController@getLogin');
	Route::post('login','Admin\AuthController@postLogin');
	Route::get('logout','AdminController@getLogout');

	//Dashboard
	Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'AdminController@index']);

	//Tag
	Route::get('tag/search', ['as' => 'tag.search', 'uses' => 'Admin\TagController@getSearch']);
	Route::get('tag', ['as' => 'tag.index', 'uses' => 'Admin\TagController@index']);
	Route::get('tag/create', ['as' => 'tag.create', 'uses' => 'Admin\TagController@create']);
	Route::post('tag', ['as' => 'tag.store', 'uses' => 'Admin\TagController@store']);
	Route::get('tag/{id}', ['as' => 'tag.show', 'uses' => 'Admin\TagController@show']);
	Route::put('tag/{id}', ['as' => 'tag.update', 'uses' => 'Admin\TagController@update']);
	Route::delete('tag/{id}', ['as' => 'tag.destroy', 'uses' => 'Admin\TagController@destroy']);

	//Item
	Route::get('item', ['as' => 'item.index', 'uses' => 'Admin\ItemController@index']);
	Route::get('item/create', ['as' => 'item.create', 'uses' => 'Admin\ItemController@create']);
});




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
