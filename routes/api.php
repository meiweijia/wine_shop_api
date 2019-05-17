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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () use ($router) {
    Route::resource('products', 'ProductController')->only('index', 'show');

    Route::get('banners', 'BannerController@index')->name('banners.index');

    Route::post('users/auth', 'UserController@auth')->name('users.auth');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('user_addresses', 'UserAddressController')->except(['create', 'edit']);

        Route::resource('cart', 'CartController')->only(['index', 'store', 'destroy']);
        Route::get('cart/flush', 'CartController@flush')->name('cart.flush');

        Route::resource('orders', 'OrderController')->only(['index', 'store', 'show']);

        Route::post('orders/{order}/review', 'OrderController@sendReview')->name('orders.review.store');
    });
});
