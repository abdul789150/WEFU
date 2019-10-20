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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{username}', 'ProfileController@index')->name('profile');
Route::get('/profile/newAddress/{username}', 'ProfileController@address_page')->name('addAddressPage');
Route::get('/cart/{username}','CartController@cart')->name('cart');


Route::post('/profile/update/{username}', 'ProfileController@dataUpdate')->name('profileUpdate');
Route::post('/profile/addAddress/{username}', 'ProfileController@add_address')->name('insertAddress');
Route::post('/profile/update/pass/{username}', 'ProfileController@passUpdate')->name('profileUpdatePass');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
