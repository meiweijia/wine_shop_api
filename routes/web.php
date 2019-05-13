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
    $arr = "美的落地扇     儿童绘画画笔套装     周大福珍珠耳环";
    dd(explode('     ',$arr));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
