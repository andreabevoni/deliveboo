<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// route homepage
Route::get('/', 'MainController@index')->name('index');

// route per la ricerca in homepage
Route::post('/search/{id}', 'MainController@search') -> name('search');

// route show ristorante
Route::get('/restaurant/show/{id}', 'MainController@restaurantShow') -> name('show-restaurant');

// Route USERS
Route::resource('users', 'UserController');

// Route FOOD
Route::resource('food', 'FoodController');

// Route ORDERS
Route::resource('orders', 'OrderController');

// Route Typologies
Route::resource('typologies', 'TypologyController');
