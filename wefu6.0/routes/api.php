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
Route::middleware('auth:api')->post('/addToCart', 'API\CartController@add_to_cart');
Route::middleware('auth:api')->post('/delete', 'API\CartController@delete_from_cart');
Route::middleware('auth:api')->post('/products', 'API\CartController@products_in_cart');