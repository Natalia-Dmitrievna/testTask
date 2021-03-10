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


Route::get('/', 'MainController@index');
Route::get('add', 'MainController@add')->name('add')->middleware('auth');
Route::get('{id}/edit',  'MainController@edit')->middleware('auth');
Route::post('{id}/update', 'MainController@update')->name('edit_empl');
Route::get('{id}/delete', 'MainController@delete')->middleware('auth');
Route::post('main/save', 'MainController@save')->name('new_empl');
Route::get('searchSimple', 'MainController@searchPage')->name('searchSimple');

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();



