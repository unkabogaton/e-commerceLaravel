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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::post('/order', 'App\Http\Controllers\OrderController@store')->name('order.store');

Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('order.index');

Route::get('/cart', 'App\Http\Controllers\ProductController@cart')->name('cart');

Route::get('/order_now', 'App\Http\Controllers\ProductController@orderNow')->name('orderNow');

Route::get('/remove_cart_item/{id}', 'App\Http\Controllers\ProductController@removeCartItem')->name('removeCartItem');

Route::post('/add_to_cart', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart');

Route::get('/home', 'App\Http\Controllers\ProductController@index')->name('home');

Route::get('/detail/{merienda}', 'App\Http\Controllers\ProductController@show')->name('merienda.show');



