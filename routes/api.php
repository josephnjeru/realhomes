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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Landlord routes
 */
Route::get('landlords', 'LandlordController@index');
Route::post('landlord', 'LandlordController@store');
Route::put('landlord', 'LandlordController@store');
Route::delete('landlord/{id}', 'LandlordController@destroy');
Route::get('landlord/{id}', 'LandlordController@show');

/**
 * Tenant routes
 */
Route::get('tenants', 'TenantController@index');
Route::post('tenant', 'TenantController@store');
Route::put('tenant', 'TenantController@store');
Route::delete('tenant/{id}', 'TenantController@destroy');
Route::get('tenant/{id}', 'TenantController@show');

/**
 * Estates routes
 */
Route::get('estates', 'EstateController@index');
Route::post('estate', 'EstateController@store');
Route::post('estate-update', 'EstateController@update');
Route::delete('estate/{id}', 'EstateController@destroy');
Route::get('estate/{id}', 'EstateController@show');
Route::post('update-vaccant', 'EstateController@updatevaccant')->name('vaccant');
 Route::get('deactivate/{id}', 'LandlordController@deactivate');

Route::post('process-payment','PaymentController@processPay');

Route::resource('checkoutrequest', 'CheckoutRequestController');

Route::post('checkout/{estate}','PaymentController@pay');
Route::post('checkout/','PaymentController@pay')->name('checkout')->middleware('auth');

Route::post('estate-update', 'EstateController@update')->name('update');

Route::post('search-estate', 'EstateController@search')->name('search');

//sms notification
Route::post('sms/', 'SmsController@index')->name('sms');