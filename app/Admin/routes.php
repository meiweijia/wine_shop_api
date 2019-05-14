<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('users', 'UserController')->names('admin.users');
    $router->resource('products', 'ProductController')->names('admin.products');
    $router->resource('orders', 'OrderController')->names('admin.orders');
    $router->post('orders/{order}/ship', 'OrderController@ship')->name('admin.orders.ship');
    $router->resource('banners', 'BannerController')->names('admin.banners');
});
