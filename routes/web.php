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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['namespace' => 'Web'], function () {

        Route::group(['namespace' => 'Master'], function () {
            Route::get('/user', 'UserController@index')->name('user.index');
            Route::post('/user', 'UserController@store')->name('user.store');
            Route::post('/user/{id}', 'UserController@destroy')->name('user.destroy');
            Route::post('/user/update/{id}', 'UserController@update')->name('user.update');

            Route::get('/warehouse', 'WarehouseController@index')->name('warehouse.index');
            Route::post('/warehouse', 'WarehouseController@store')->name('warehouse.store');
            Route::post('/warehouse/{id}', 'WarehouseController@destroy')->name('warehouse.destroy');
            Route::post('/warehouse/update/{id}', 'WarehouseController@update')->name('warehouse.update');
        });
        Route::group(['namespace' => 'Customer'], function () {

            Route::get('/customer', 'CustomerController@index')->name('customer.index');
            Route::post('/customer', 'CustomerController@store')->name('customer.store');
            Route::post('/customer/{id}', 'CustomerController@destroy')->name('customer.destroy');
            Route::post('/customer/update/{id}', 'CustomerController@update')->name('customer.update');

            Route::post('/provincestore', 'CustomerController@provincestore')->name('province.store');
            Route::post('/regionstore', 'CustomerController@regionstore')->name('region.store');

            Route::get('/ship', 'ShipController@index')->name('ship.index');
            Route::post('/ship', 'ShipController@store')->name('ship.store');
            Route::post('/ship/{id}', 'ShipController@destroy')->name('ship.destroy');
            Route::post('/ship/update/{id}', 'ShipController@update')->name('ship.update');

        });

        Route::get('/category', 'CategoryController@index')->name('category.index');
        Route::post('/category', 'CategoryController@store')->name('category.store');
        Route::post('/category/{id}', 'CategoryController@destroy')->name('category.destroy');
        Route::post('/category/update/{id}', 'CategoryController@update')->name('category.update');

        Route::get('/product', 'productController@index')->name('product.index');
        Route::post('/product', 'productController@store')->name('product.store');
        Route::post('/product/{id}', 'productController@destroy')->name('product.destroy');
        Route::post('/product/update/{id}', 'productController@update')->name('product.update');

        Route::get('/status', 'statusController@index')->name('status.index');
        Route::post('/status', 'statusController@store')->name('status.store');
        Route::post('/status/{id}', 'statusController@destroy')->name('status.destroy');
        Route::post('/status/update/{id}', 'statusController@update')->name('status.update');

        Route::get('/type', 'typeController@index')->name('type.index');
        Route::post('/type', 'typeController@store')->name('type.store');
        Route::post('/type/{id}', 'typeController@destroy')->name('type.destroy');
        Route::post('/type/update/{id}', 'typeController@update')->name('type.update');

        Route::get('/trash', 'trashController@index')->name('trash.index');
        Route::post('/trash', 'trashController@store')->name('trash.store');
        Route::post('/trash/{id}', 'trashController@destroy')->name('trash.destroy');
        Route::post('/trash/update/{id}', 'trashController@update')->name('trash.update');

        Route::get('/invoice', 'invoiceController@index')->name('invoice.index');
        Route::post('/invoice', 'invoiceController@store')->name('invoice.store');
        Route::post('/invoice/{id}', 'invoiceController@destroy')->name('invoice.destroy');
        Route::post('/invoice/update/{id}', 'invoiceController@update')->name('invoice.update');

        Route::get('/report', 'reportController@index')->name('report.index');
        Route::post('/report', 'reportController@store')->name('report.store');
        Route::post('/report/{id}', 'reportController@destroy')->name('report.destroy');
        Route::post('/report/update/{id}', 'reportController@update')->name('report.update');



        Route::get('/history', 'historyController@index')->name('history.index');
        Route::post('/history', 'historyController@store')->name('history.store');
        Route::post('/history/{id}', 'historyController@destroy')->name('history.destroy');
        Route::post('/history/update/{id}', 'historyController@update')->name('history.update');
    });
});