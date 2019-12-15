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
////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
Route::post('/profile/update/pass/{username}', 'profile_controller@passUpdate')->name('profileUpdatePass');
Route::post('/profile/update/{username}', 'profile_controller@dataUpdate')->name('profileUpdate');

////////////////////////////////////////////////////////////////////////////////
//
//
//      CUSTOMER ROUTES
//
//
///////////////////////////////////////////////////////////////////////////////

// Modified routes with grouping
Route::group(['prefix' => 'customer', 'middleware' => 'role:customer'],function(){
    Route::get('/profile/newAddress/{username}', 'profile_controller@address_page')->name('addAddressPage');
    Route::get('/cart/{username}','cart_controller@cart')->name('cart');
    Route::get('/orders','order_controller@index')->name('ordersIndex');
    Route::get('/shippmentDetails','order_controller@shippment_details')->name('shippmentDetails');
    Route::get('/shippingOption/{address_id}','order_controller@shipping_option')->name('shippingOption');
    Route::get('/orderConfirmation/{address_id}/{pp_id}', 'order_controller@order_confirmation')->name('orderConfirmation');
    Route::get('/orders/completedOrders', 'order_controller@completed_orders')->name('completedOrders');
    Route::get('/orders/incompleteOrders', 'order_controller@incomplete_orders')->name('incompleteOrders'); 
    Route::get('/paymentMethods','PaymentController@payment_index')->name('paymentMethods');   
///////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\//////////\\\\\
    Route::post('/profile/addAddress/{username}', 'profile_controller@add_address')->name('insertAddress');
    Route::post('/checkout','cart_controller@checkout')->name('checkout');
    Route::post('/selectedAddress','order_controller@selected_address')->name('selectedAddress');
    Route::post('/saveSelectedAddress','order_controller@save_selected_address')->name('saveSelectedAddress');
    Route::post('/selectedPricingPlan', 'order_controller@selected_pricing_plan')->name('selectedPricingPlan');
    Route::post('/placeOrder','order_controller@place_order')->name('placeOrder');
    Route::post('/paymentCheckout','PaymentController@payment_checkout')->name('paymentCheckout');
});


////////////////////////////////////////////////////////////////////////////////
//
//
//      ADMIN ROUTES
//
//
///////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'],function(){
    Route::get('/ordersList','Admin\OrderController@orders_list')->name('ordersList');
    Route::get('/manageOrders','Admin\OrderController@manage_orders')->name('manageOrders');
    Route::get('/updatePricingPlan', 'Admin\ManagementController@update_pricing_plan')->name('updatePricingPlan');
    Route::get('/createUser', 'Admin\ManagementController@create_user')->name('createUser');
    Route::get('/manageShippments','Admin\ShippmentController@manage_shippments')->name('manageShippments');
    Route::get('/shippmentDetails/{id}','Admin\ShippmentController@amazon_shipment_details')->name('amazonShipmentDetails');
    Route::get('/orderDetails/{id}','Admin\ShippmentController@orders_details')->name('ordersDetails');
    ///////////////////////////////////////////////////////////////////////////////////////
    Route::post("/savePricingPlan","Admin\ManagementController@save_pricing_plan")->name('savePricingPlan');
    Route::post('/orderClusterConfrimation', 'Admin\OrderController@cluster_confirmation')->name('clusterConfrimation');
});
