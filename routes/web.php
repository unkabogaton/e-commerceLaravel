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




Route::get('/add-delivery', function () {
    return view('add-delivery');
})->middleware(['auth'])->name('add-delivery');





Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::post('/check-out', 'App\Http\Controllers\ProductController@checkOut')->name('check-out')->middleware(['auth']);

Route::get('/order', 'App\Http\Controllers\ProductController@deliveries')->name('deliveries')->middleware(['auth']);

Route::get('/cart', 'App\Http\Controllers\ProductController@cart')->name('cart')->middleware(['auth']);

Route::get('/order-info/{id}', 'App\Http\Controllers\ProductController@showOrder')->name('show-order');

Route::get('/all-orders', 'App\Http\Controllers\ProductController@allOrders')->name('all-orders')->middleware(['auth']);

Route::get('/order/{id}', 'App\Http\Controllers\ProductController@eachOrder')->name('order-detail');

Route::get('/delivery/{id}', 'App\Http\Controllers\ProductController@delivery')->name('delivery-detail');

Route::get('/order-summary', 'App\Http\Controllers\ProductController@orderSummary')->name('order-summary')->middleware(['auth']);

Route::get('/cancel-order/{id}', 'App\Http\Controllers\ProductController@cancelOrder')->name('cancel-order');

Route::post('/edit-order/{id}', 'App\Http\Controllers\ProductController@editOrder')->name('edit-order');

Route::post('/edit-delivery/{id}', 'App\Http\Controllers\ProductController@editDelivery')->name('edit-delivery');

Route::get('/remove_cart_item/{id}', 'App\Http\Controllers\ProductController@removeCartItem')->name('removeCartItem');

Route::get('/delete-delivery/{id}', 'App\Http\Controllers\ProductController@deleteDelivery')->name('delete-delivery');

Route::post('/add_to_cart', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart')->middleware(['auth']);

Route::post('/place_order', 'App\Http\Controllers\ProductController@placeOrder')->name('placeOrder');

Route::post('/add-delivery', 'App\Http\Controllers\ProductController@addDelivery')->name('add-delivery');

Route::post('/addQty/{id}', 'App\Http\Controllers\ProductController@addQty')->name('addQty');

Route::post('/minusQty/{id}', 'App\Http\Controllers\ProductController@minusQty')->name('minusQty');

Route::get('/', 'App\Http\Controllers\ProductController@index')->name('home');

Route::get('/detail/{merienda}', 'App\Http\Controllers\ProductController@show')->name('merienda.show');

Route::get('search', 'App\Http\Controllers\ProductController@search')->name('search');

require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
