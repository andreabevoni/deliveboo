<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

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

//upload User Img
Route::post('/upload/avatar', 'UserController@uploadAvatar')->name('upload-avatar');

//clear User img
Route::get('/clear/avatar', 'UserController@clearImg')->name('clear-avatar');



// test per carrello
Route::get('/cart', 'MainController@testCart')->name('test-cart');
Route::get('/shop', 'MainController@testShop')->name('test-shop');
