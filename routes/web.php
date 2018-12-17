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
    return view('admin\\dashboard');
});


Auth::routes();

Route::get('/article', 'HomeController@index');

Route::resource('category', 'Category\\CategoryController');
Route::resource('deposit', 'Deposit\\DepositController');
Route::resource('brand', 'Brand\\BrandController');
Route::resource('article', 'Article\\ArticleController');
Route::resource('customer', 'Customer\\CustomerController');
Route::resource('supplier', 'Supplier\\SupplierController');

Route::resource('sale', 'Sale\\SaleController');

Route::get('querydb','SearchLiveController@query');
Route::resource('deliverynote', 'DeliveryNote\\DeliveryNoteController');
Route::resource('checking-account', 'CheckingAccount\\CheckingAccountController');

Route::resource('unit-measure', 'UnitMeasure\\UnitMeasureController');