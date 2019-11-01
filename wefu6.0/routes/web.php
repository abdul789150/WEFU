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
Route::get('/profile/{username}', 'profile_controller@index')->name('profile');
Route::get('/profile/newAddress/{username}', 'profile_controller@address_page')->name('addAddressPage');
Route::get('/cart/{username}','cart_controller@cart')->name('cart');
Route::get('/orders','order_controller@index')->name('ordersIndex');
Route::get('/shippmentDetails','order_controller@shippment_details')->name('shippmentDetails');
Route::get('/shippingOption/{address_id}','order_controller@shipping_option')->name('shippingOption');
Route::get('/orderConfirmation/{address_id}/{pp_id}', 'order_controller@order_confirmation')->name('orderConfirmation');
Route::get('/orders/completedOrders', 'order_controller@completed_orders')->name('completedOrders');
Route::get('/orders/incompleteOrders', 'order_controller@incomplete_orders')->name('incompleteOrders');







Route::post('/profile/update/{username}', 'profile_controller@dataUpdate')->name('profileUpdate');
Route::post('/profile/addAddress/{username}', 'profile_controller@add_address')->name('insertAddress');
Route::post('/profile/update/pass/{username}', 'profile_controller@passUpdate')->name('profileUpdatePass');
Route::post('/checkout','cart_controller@checkout')->name('checkout');
Route::post('/selectedAddress','order_controller@selected_address')->name('selectedAddress');
Route::post('/saveSelectedAddress','order_controller@save_selected_address')->name('saveSelectedAddress');
Route::post('/selectedPricingPlan', 'order_controller@selected_pricing_plan')->name('selectedPricingPlan');
Route::post('/placeOrder','order_controller@place_order')->name('placeOrder');