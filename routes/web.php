<?php

use Illuminate\Support\Facades\Route;

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

//Home Page Routes
Route::get('/','HomeController@index')->name('homePage');
Route::get('fetch_data', 'HomeController@fetchData');

//Category Routes
Route::resource('categories', 'CategoryController')->except(['create','update']);
Route::delete('categories/{id}/soft-delete', 'CategoryController@softDelete')->name('categories.softDelete');
Route::put('categories/update', 'CategoryController@update')->name('categories.update');

//Courses Routes
Route::resource('all-courses', 'CourseController');
