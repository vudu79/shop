<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function (){

    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin'], function () {
        Route::get('/', 'OrderController@index')->name('home');
        Route::get('/show/{order}', 'OrderController@show')->name('order.show');
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });

    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as'=>'person.'], function () {
        Route::get('/','OrderController@index')->name('order.index');
        Route::get('/show/{order}', 'OrderController@show')->name('order.show');
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });


});


Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');


Route::get('/', 'MainController@index')->name('main');
Route::get('/categories', 'MainController@categories')->name('categories');
Route::get('/category/{category}', 'MainController@category')->name('category');
Route::get('/product/{product}', 'MainController@product')->name('product');
Route::get('/basket', 'BasketController@basket')->name('basket')->middleware('emptybasket');
Route::get('/basket/place/{order}', 'BasketController@basketPlace')->name('basket.place');
Route::post('/basket/confirm', 'BasketController@basketConfirm')->name('basket.confirm');
Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket.add');
Route::delete('/basket/remove/{id}', 'BasketController@basketRemove')->name('basket.remove');

Auth::routes();

