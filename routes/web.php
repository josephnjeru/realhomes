<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'EstateController@index');

Auth::routes();

Route::get('/home', 'EstateController@index')->name('home');

Route::get('/all', 'EstateController@index');

Route::get('/create', 'EstateController@create')->middleware('auth','landlord');

//Route::resource('estates', 'EstateController');
//get estates owned by one landlord
Route::get('my-estates','LandlordController@getEstates')->name('my-estates');

Route::get('checkout1','PaymentController@authenticate');
//show estate details
Route::get('estate/{id}', 'EstateController@show');

//show estate details to customer
Route::get('view-estate/{id}', 'EstateController@showDetails');

Route::middleware('auth')->group(function(){
    Route::get('create-account', 'LandlordController@create')->middleware('auth','landlord');
    Route::post('landlord', 'LandlordController@store');
});

Route::get('select-account', function(){
    return view('account.select');
});


//search house


//edit house details
Route::get('edit/{id}', 'EstateController@edit');

 Route::get('admin', 'AdminController@index')->name('admin')->middleware('auth','admin');

  Route::get('admin/landlords', 'AdminController@showlandlords')->name('landlords');

    Route::get('admin/activate/{id}', 'AdminController@activate');
    Route::get('admin/deactivate/{id}', 'AdminController@deactivate');

    Route::get('admin/estates', 'AdminController@showestates')->name('estates');

    Route::get('admin/activate-estate/{id}', 'AdminController@activate_estate');

    Route::get('admin/deactivate-estate/{id}', 'AdminController@deactivate_estate')->name('d');

       

    Route::get('test', function(){
        dd(Auth::user());
    });

    Route::get('update_vaccant/{id}', 'EstateController@showvaccant');