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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

# VIEWS - FREE
Route::get('/', function () {
    return redirect('/login');
})->name('welcome');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

# VIEWS - LITE
Route::get('/virus-data', function () {
    return view('virus-data.virus-data');
})->name('virus-data');

Route::post('/contact-us', function () {
    return view('errors.404');
})->name('contact-us');

// Licenses
Route::get('/upgrade', 'License\LicenseController@upgrade')->name('license-upgrade');
Route::get('/upgrade-to/{type}', 'License\LicenseController@upgradeTo')->name('upgrade-to');
Route::post('/checkout', 'License\LicenseController@checkout')->name('checkout');
// Company
Route::get('/my-company', 'Company\CompanyController@myCompany')->name('my-company');
Route::put('/my-company', 'Company\CompanyController@updateMyCompany')->name('update-my-company');
// Account
Route::get('/my-account', 'Account\AccountController@myAccount')->name('my-account');
Route::put('/my-account', 'Account\AccountController@updateMyAccount')->name('update-my-account');
Route::post('/my-account/logout-all', 'Account\AccountController@logoutAll')->name('logout-all');
// Warehouse
Route::get('/warehouses', 'Warehouse\WarehouseController@index')->name('warehouses');
Route::get('/warehouses/edit/{id}', 'Warehouse\WarehouseController@edit')->name('warehouse-edit');
Route::put('/warehouses', 'Warehouse\WarehouseController@updateForm')->name('update-form-warehouse');
Route::post('/warehouses', 'Warehouse\WarehouseController@createForm')->name('create-form-warehouse');
Route::delete('/warehouses', 'Warehouse\WarehouseController@deleteForm')->name('delete-form-warehouse');
Route::put('/warehouses/{id}', 'Warehouse\WarehouseController@update')->name('update-warehouse');
// Products
Route::get('/products', 'Product\ProductController@index')->name('products');
Route::get('/products/edit/{id}', 'Product\ProductController@edit')->name('product-edit');
Route::put('/products', 'Product\ProductController@updateForm')->name('update-form-product');
Route::post('/products', 'Product\ProductController@createForm')->name('create-form-product');
Route::delete('/products', 'Product\ProductController@deleteForm')->name('delete-form-product');
Route::put('/products/{id}', 'Product\ProductController@update')->name('update-product');
// Categories
Route::get('/categories', 'Category\CategoryController@index')->name('categories');
Route::get('/categories/edit/{id}', 'Category\CategoryController@edit')->name('category-edit');
Route::put('/categories', 'Category\CategoryController@updateForm')->name('update-form-category');
Route::post('/categories', 'Category\CategoryController@createForm')->name('create-form-category');
Route::delete('/categories', 'Category\CategoryController@deleteForm')->name('delete-form-category');
Route::put('/categories/{id}', 'Category\CategoryController@update')->name('update-category');
// Clients
Route::get('/clients', 'Client\ClientController@index')->name('clients');
Route::get('/clients/edit/{id}', 'Client\ClientController@edit')->name('client-edit');
Route::put('/clients/{id}', 'Client\ClientController@update')->name('update-client');
// Orders
Route::get('/orders', 'Order\OrderController@index')->name('orders');
Route::get('/orders/edit/{id}', 'Order\OrderController@edit')->name('order-edit');
Route::put('/orders/{id}', 'Order\OrderController@update')->name('update-order');
// Sales
Route::get('/electronic-invoice', 'Sale\SaleController@electronicInvoice')->name('electronic-invoice');
Route::get('/sales', 'Sale\SaleController@index')->name('sales');
Route::get('/new-sale', 'Sale\SaleController@newSale')->name('new-sale');
// AUTH ROUTES AND NEW AUTH ROUTES
Auth::routes();
Route::get('/register', function () {
    return redirect('/login');
})->name('register');
Route::post('/password/email', 'Auth\ResetPasswordController@passwordEmail');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/email/verification/resend', function() {
    return redirect('/');
})->name('verification.resend');