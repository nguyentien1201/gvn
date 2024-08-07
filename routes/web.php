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
    Route::get('/green-beta', 'HomeController@greenBeta')->name('home.green-beta');
    Route::get('/green-alpha', 'HomeController@greenAlpha')->name('home.green-alpha');
    Route::get('api/get-history-signal/{id}', 'HomeController@getHistorySignal')->name('api.history-signal');
    Route::get('api/get-history-alpha/{id}', 'HomeController@getHistoryAlphaSignal')->name('api.history-signal-alpha');
    Route::get('/greenstock-nas100', 'HomeController@greenStock')->name('home.green-stock');
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
    Route::resource('green-alpha', 'GreenAlphaController')->middleware('admin');
    Route::resource('portfolio', 'PortfolioController')->middleware('admin');
    Route::resource('nas100', 'GreenStockNas100Controller')->middleware('admin');

});
Route::get('admin/greenalpha/{id}', 'Admin\GreenAlphaController@getListMstock')->middleware('admin')->name('admin.green-alpha.list-stock');
Route::get('admin/profolio/{id}', 'Admin\PortfolioController@getPortfolio')->middleware('admin')->name('admin.green-alpha.portfolio');
Route::post('admin/green-alpha/import', 'Admin\GreenAlphaController@import')->middleware('admin')->name('admin.green-alpha.import');
Route::get('admin/greenbeta/{id}', 'Admin\GreenBetaController@getListMstock')->middleware('admin')->name('admin.green-beta.list-stock');
Route::post('admin/green-beta/import', 'Admin\GreenBetaController@import')->middleware('admin')->name('admin.green-beta.import');
Route::get('admin/list-code', 'Admin\GreenAlphaController@portfolio')->middleware('admin')->name('admin.green-alpha.list-code');
Route::post('admin/green-alpha/import-portfolio', 'Admin\GreenAlphaController@importPortfolio')->middleware('admin')->name('admin.green-alpha.import-portfolio');
Route::post('admin/signal-free/import', 'Admin\SignalFreeController@import')->middleware('admin')->name('admin.signalfree.import');
Route::post('admin/green-stock-nas100/import', 'Admin\GreenStockNas100Controller@import')->middleware('admin')->name('admin.nas100.import');
