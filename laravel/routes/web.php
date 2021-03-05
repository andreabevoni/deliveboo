<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

// route homepage
Route::get('/', 'MainController@index')->name('index');

// route per la ricerca in homepage
Route::post('/search', 'MainController@Search')->name('search');

// Route USERS
Route::resource('users', 'UserController');

// Route FOOD
Route::resource('food', 'FoodController');
// Route::get('food/create/', 'FoodController@create')->name('create-food');
// Route::post('food/store/', 'FoodController@store')->name('store-food');
Route::get('form/restore/food', 'FoodController@goToRestore')->name('food-restore');
Route::post('/restore/food', 'FoodController@restore')->name('restore-task');
Route::get('/food/softdelete/{id}', 'FoodController@destroy')->name('softdelete-food');
//upload Food Img
Route::post('/food/image/upload', 'FoodController@uploadFood')->name('upload-food-img');
//clear Food img
Route::get('/clear/image/clear', 'FoodController@clearImg')->name('clear-food-img');



// Route ORDERS
Route::resource('orders', 'OrderController');

// Route Typologies
Route::resource('typologies', 'TypologyController');

// Route Index User
Route::get('/index', 'UserController@indexUser')->name('index');

// Route Show User
// Route::get('/show/{id}', 'UserController@showUser')->name('user-show');

//upload User Img
Route::post('/upload/avatar', 'UserController@uploadAvatar')->name('upload-avatar');

//clear User img
Route::get('/clear/avatar', 'UserController@clearImg')->name('clear-avatar');



// test per carrello
Route::get('/cart', 'MainController@testCart')->name('test-cart');
Route::get('/shop', 'MainController@testShop')->name('test-shop');
Route::get('/show/{id}', 'MainController@testShow')->name('user-show');
Route::get('/checkout/{id}', 'MainController@checkout')->name('checkout');
