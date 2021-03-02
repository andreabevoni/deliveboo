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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route USERS
Route::resource('users', 'UserController');

// Route FOOD
Route::resource('food', 'FoodController');
Route::get('food/create/', 'FoodController@create')->name('create-food');
Route::post('food/store/', 'FoodController@store')->name('store-food');

// Route ORDERS
Route::resource('orders', 'OrderController');

// Route Typologies
Route::resource('typologies', 'TypologyController');
