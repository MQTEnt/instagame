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
Route::get('admin/login','Admin\AuthController@getLogin');
Route::post('admin/login','Admin\AuthController@postLogin');
// Route::get('admin/register','Admin\AuthController@getRegister');
// Route::post('admin/register','Admin\AuthController@postRegister');
Route::get('admin/dashboard','AdminController@getIndex');
Route::get('admin/logout','AdminController@getLogout');





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
