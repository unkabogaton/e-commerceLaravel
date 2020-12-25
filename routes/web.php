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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/order', function () {
    return view('order');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::post('/checkOut', 'App\Http\Controllers\ProductController@checkOut')->name('checkOut');

Route::get('/cart', 'App\Http\Controllers\ProductController@cart')->name('cart');

Route::get('/all-orders', 'App\Http\Controllers\ProductController@allOrders')->name('all-orders');

Route::get('/order/{id}', 'App\Http\Controllers\ProductController@eachOrder')->name('eachorder');

Route::get('/order-summary', 'App\Http\Controllers\ProductController@orderSummary')->name('order-summary');

Route::get('/remove_cart_item/{id}', 'App\Http\Controllers\ProductController@removeCartItem')->name('removeCartItem');

Route::post('/add_to_cart', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart');

Route::post('/place_order', 'App\Http\Controllers\ProductController@placeOrder')->name('placeOrder');

Route::post('/addQty/{id}', 'App\Http\Controllers\ProductController@addQty')->name('addQty');

Route::post('/minusQty/{id}', 'App\Http\Controllers\ProductController@minusQty')->name('minusQty');

Route::get('/home', 'App\Http\Controllers\ProductController@index')->name('home');

Route::get('/detail/{merienda}', 'App\Http\Controllers\ProductController@show')->name('merienda.show');



