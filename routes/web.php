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
	Route::get('tag/list', 'Admin\TagController@getList');
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
	Route::post('item', ['as' => 'item.store', 'uses' => 'Admin\ItemController@store']);
	Route::get('item/detail/{id}', ['as' => 'item.show', 'uses' => 'Admin\ItemController@show']);
	Route::get('item/{id}', 'Admin\ItemController@getItemById');
	Route::put('item/{id}', 'Admin\ItemController@update');
	Route::delete('item/{id}', 'Admin\ItemController@destroy');
	Route::get('item/checkName/{name}', 'Admin\ItemController@checkName');
	Route::get('item/getTags/{id}', 'Admin\ItemController@getTagsByItemId');

	//Game
	Route::get('game', ['as' => 'game.index', 'uses' => 'Admin\GameController@index']);
	Route::get('game/create', ['as' => 'game.create', 'uses' => 'Admin\GameController@create']);
	Route::post('game', ['as' => 'game.store', 'uses' => 'Admin\GameController@store']);
	Route::get('game/detail/{id}', ['as' => 'game.show', 'uses' => 'Admin\GameController@show']);
	Route::get('game/{id}', 'Admin\GameController@getGameById');
	Route::put('game/{id}', 'Admin\GameController@update');
	Route::delete('game/{id}', 'Admin\GameController@destroy');
	Route::get('game/checkName/{name}', 'Admin\GameController@checkName');
	Route::get('game/getTags/{id}', 'Admin\GameController@getTagsByGameId');
});

Route::get('/home', 'HomeController@index')->name('home');

//Login
Route::get('/login', 'UserLoginController@login');
Route::get('/logout', 'UserLoginController@logout');

//Login Facebook
Route::get('/facebook', 'UserLoginController@redirectToProvider')->name('facebook.login');
Route::get('/facebook/calback', 'UserLoginController@handleProviderCallback');



//Example
Route::get('index', function(){
	return view('index.home');
});
Route::get('play/{id}', function($game_id){
	$game = App\Game::find($game_id);
	return view('play', ['game' => $game]);
});
