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

// Route::redirect('/', '/login');
Route::group(['prefix' => '', 'as' => 'front.', 'namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
});

Auth::routes(['register' => false]);



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    //test send message
    Route::get('/test-send-message', 'AdminController@testSendMessage');
    Route::get('/login', 'LoginController@getLogin')->name('login');
    Route::post('/login', 'LoginController@postLogin')->name('postLogin');
    Route::get('/', function () {
        return redirect()->route('admin.customers.index');
    })->name('home');

    Route::group(['prefix' => '/profile', 'as' => 'profile.', 'middleware' => 'staff'], function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::put('/update/{id}', 'ProfileController@update')->name('update');
    });
    //Users
    Route::resource('users', 'UserController')->middleware('admin');
    //Customers
    Route::prefix('/customers')->group(function (): void {
        Route::post('/customers/import/', 'CustomerController@import')->name('customers.import');
    });
    Route::resource('customers', 'CustomerController')->middleware('admin');
    //Oauth Token
    Route::resource('tokens', 'TokenController')->middleware('admin');
    //Promotions
    Route::resource('promotions', 'PromotionController')->middleware('admin');
    Route::resource('mst-stock', 'MstStockController')->middleware('admin');
    Route::resource('stock-green-beta', 'MstStockGreenController')->middleware('admin');
    Route::resource('green-beta', 'GreenBetaController')->middleware('admin');
    Route::resource('freesignal', 'SignalFreeController')->middleware('admin');
});




