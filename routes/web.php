<?php

Route::get('/','PagesCtrl@index')->name('front');
Route::get('/shirts','PagesCtrl@shirts')->name('shirts');
Route::get('/shirts/{product}','PagesCtrl@shirt')->name('shirt');

Route::resource('/cart', 'CartCtrl');
Route::get('/cart/add-items/{id}', 'CartCtrl@addItem')->name('cart.addItem');

// User Routes
Auth::routes();

// Route::get('checkout','CheckoutCtrl@login')->name('checkout');

Route::group(['middleware'=>'auth'],function(){

	Route::get('shipping-info','CheckoutCtrl@shipping')->name('checkout.shipping');

	// Route::resource('review','ProductReviewController');

	//Pay With Stripe
	Route::get('payment','CheckOutCtrl@payment')->name('checkout.payment');
	Route::post('store-payment','CheckOutCtrl@store')->name('checkout.store');

	//Pay With Paypal
	Route::get('pay-with-paypal','CheckOutCtrl@payWithPaypal')->name('checkout.paypal');

	Route::get('paypal-success','CheckOutCtrl@paypalSuccess')->name('checkout.paypal-success');
});

Route::get('test',function(){

	$orders = App\Order::find(2);
	$items = $orders->$orderItems;
	dd($items);
});

Route::resource('address','AddressCtrl');

Route::get('Verify/{email}/{verifyToken}','Auth\RegisterController@sendingEmail')->name('sendingEmail');

Route::get('/home', 'HomeController@index')->name('home');



// Admin routes

Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){

	Route::resource('product','Admin\ProductsCtrl');
	Route::resource('shirts','Admin\ShirtsCtrl');
	Route::resource('category','CategoriesCtrl');
	//display the orders
	Route::get('orders/{type?}', 'OrderCtrl@Orders');

	//check if the order is delivered or not
	Route::post('toggledeliver/{orderId}', 'OrderCtrl@toggledeliver')->name('toggle.deliver');

});
Route::get('/logout', 'Auth\LoginController@logout');
