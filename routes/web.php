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
Route::get('/cetak/pdf/{id}', 'Web\Invoice\ReportController@cetak_pdf')->name('report.cetak');
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
            Route::post('/customershow', 'CustomerController@show')->name('customer.show');

            Route::post('/provincestore', 'CustomerController@provincestore')->name('province.store');
            Route::post('/regionstore', 'CustomerController@regionstore')->name('region.store');

            Route::get('/ship', 'ShipController@index')->name('ship.index');
            Route::post('/ship', 'ShipController@store')->name('ship.store');
            Route::post('/ship/{id}', 'ShipController@destroy')->name('ship.destroy');
            Route::post('/ship/update/{id}', 'ShipController@update')->name('ship.update');
            Route::post('/shipshow', 'ShipController@show')->name('ship.show');
        });
        Route::group(['namespace' => 'Product'], function () {

            Route::get('/category', 'CategoryController@index')->name('category.index');
            Route::post('/category', 'CategoryController@store')->name('category.store');
            Route::post('/category/{id}', 'CategoryController@destroy')->name('category.destroy');
            Route::post('/category/update/{id}', 'CategoryController@update')->name('category.update');

            Route::get('/product', 'ProductController@index')->name('product.index');
            Route::post('/product', 'ProductController@store')->name('product.store');
            Route::post('/product/{id}', 'ProductController@destroy')->name('product.destroy');
            Route::post('/product/update/{id}', 'ProductController@update')->name('product.update');
            Route::get('/search', 'ProductController@search')->name('product.search');
            Route::delete('/product-delete-all', 'ProductController@deleteAll')->name('product.deleteall');

            Route::get('/status', 'StatusController@index')->name('status.index');
            Route::post('/status', 'StatusController@store')->name('status.store');
            Route::post('/status/{id}', 'StatusController@destroy')->name('status.destroy');
            Route::post('/status/update/{id}', 'StatusController@update')->name('status.update');

            Route::get('/type', 'TypeController@index')->name('type.index');
            Route::post('/type', 'TypeController@store')->name('type.store');
            Route::post('/type/{id}', 'TypeController@destroy')->name('type.destroy');
            Route::post('/type/update/{id}', 'TypeController@update')->name('type.update');

            Route::get('/trash', 'TrashController@index')->name('trash.index');
            Route::get('/trash', 'TrashController@index')->name('trash.index');
            Route::post('/restore/{id}', 'TrashController@restore')->name('trash.restore');
            Route::post('/hapus/{id}', 'TrashController@hapus')->name('trash.hapus');

            Route::get('/mutasi', 'MutasiController@mutasiindex')->name('mutasi.index');
            Route::get('/mutasihistory', 'MutasiController@history')->name('mutasi.history');
            Route::post('/mutasi/add', 'MutasiController@mutasiadd')->name('mutasi.add');
            Route::post('/massal', 'MutasiController@mutasimass')->name('mutasi.mass');
            Route::post('/mutasi/destroy/{sn}', 'MutasiController@mutasidestroy')->name('mutasi.destroy');
        });

        Route::group(['namespace' => 'Invoice'], function () {

            Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
            Route::post('/invoice', 'InvoiceController@store')->name('invoice.store');
            Route::get('/cari', 'InvoiceController@cari')->name('invoice.cari');
            Route::post('/invoice/add', 'InvoiceController@add')->name('invoice.add');
            Route::post('/invoice/{id}', 'InvoiceController@destroy')->name('invoice.destroy');
            Route::post('/invoice/update/{id}', 'InvoiceController@update')->name('invoice.update');

            Route::post('/invoicestempel', 'InvoiceController@stempel')->name('invoice.stempel');
            Route::post('/updateprice/{id}', 'InvoiceController@updateprice')->name('update.price');
            Route::post('/updatediscount', 'InvoiceController@updatediscount')->name('update.discount');
            Route::post('/updatesign', 'InvoiceController@updatesign')->name('update.sign');
            Route::post('/checkout', 'InvoiceController@checkout')->name('checkout');
            Route::post('/checkoutperforma', 'InvoiceController@checkoutperforma')->name('checkout.performa');

            Route::get('/createInvoice', 'PlotController@create_invoice')->name('create.invoice');
            Route::get('/createPerforma', 'PlotController@create_performa')->name('create.performa');

            Route::post('/invoiceInfo', 'PlotController@invoiceInfostore')->name('invoiceInfo.store');
            Route::get('/customerinfo', 'PlotController@customerInfo')->name('customerinfo');
            Route::get('/transferinfo', 'PlotController@transferInfo')->name('transferinfo');
            Route::get('/transferinfo', 'PlotController@transferInfo')->name('transferinfo');
            Route::get('/airtimeinfo', 'PlotController@airtimeInfo')->name('airtimeinfo');
            Route::get('/userinfo', 'PlotController@userInfo')->name('userinfo');


            Route::post('/customerinfostore', 'PlotController@customerInfostore')->name('customerInfostore');
            Route::post('/transferinfostore', 'PlotController@transferInfoStore')->name('transferInfoStore');
            Route::post('/airtimeinfostore', 'PlotController@airtimeInfoStore')->name('airtimeinfo.store');

            Route::get('/reportinvoice', 'ReportController@index')->name('report.index');
            Route::post('/report', 'ReportController@store')->name('report.store');
            Route::post('/report/{id}', 'ReportController@destroy')->name('report.destroy');
            Route::post('/report/update/{id}', 'ReportController@update')->name('report.update');
            Route::post('/reportdelete/{id}', 'ReportController@delete')->name('report.delete');

        });




        Route::get('/history', 'HistoryController@index')->name('history.index');
    });
});