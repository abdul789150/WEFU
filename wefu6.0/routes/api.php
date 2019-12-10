<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\LoginController@login');
Route::post('/signup', 'API\RegisterController@register');
Route::middleware('auth:api')->post('/addToCart', 'API\CartController@add_to_cart');
Route::middleware('auth:api')->post('/delete', 'API\CartController@delete_from_cart');
Route::middleware('auth:api')->post('/products', 'API\CartController@products_in_cart');
Route::middleware('auth:api')->post('/updateImage', 'API\UserController@update_image');
Route::middleware('auth:api')->post('/newAddress', 'API\UserController@add_new_address');
Route::middleware('auth:api')->post('/updateInfo', 'API\UserController@update_info');
Route::middleware('auth:api')->post('/updatePassword', 'API\UserController@update_password');
Route::middleware('auth:api')->post('/completeRegistration', 'API\UserController@complete_registration');
Route::middleware('auth:api')->post('/addresses','API\UserController@get_addresses');
Route::middleware('auth:api')->post('/androidAddToCart', 'API\CartController@android_add_to_cart');
Route::middleware('auth:api')->post('/cartDetails', 'API\CartController@android_cart_details');
Route::middleware('auth:api')->post('/productsCheckout', 'API\OrderController@checkout_save_quantity');