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
Route::get('/register', 'Auth/RegisterController@showRegistrationForm')->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::group(['prefix' => '', 'as' => 'front.', 'namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/green-beta', 'HomeController@greenBeta')->name('home.green-beta')->middleware(['auth']);
    Route::get('/green-alpha', 'HomeController@greenAlpha')->name('home.green-alpha')->middleware(['auth']);
    Route::get('api/get-history-signal/{id}', 'HomeController@getHistorySignal')->name('api.history-signal');
    Route::get('api/get-history-alpha/{id}', 'HomeController@getHistoryAlphaSignal')->name('api.history-signal-alpha');
    Route::get('/greenstock-nas100', 'HomeController@greenStock')->name('home.green-stock')->middleware(['auth']);
    Route::get('api/get-market-greenstock', 'HomeController@getMarketGreenStock')->name('api.market-greenstock');
    Route::get('api/get-top-stock', 'HomeController@getTopStock')->name('api.top-stock');
    Route::get('trading-system', 'HomeController@tradingSystem')->name('home.trading-system');
    Route::get('contact', 'HomeController@contact')->name('home.contact');
    Route::get('mission', 'HomeController@mission')->name('home.mission');

});

Auth::routes(['register' => true]);


Route::group([ 'namespace' => 'Front'], function () {
    Route::post('api/buy-product', 'SubscriptionController@store')->name('api.buy-product')->middleware('customer');
    Route::post('api/update-subscription', 'SubscriptionController@apiUpdateSubscription')->name('api.update-subscription')->middleware('customer');

    Route::get('/account', 'CustomerController@myAccount')->name('account')->middleware('customer');
    Route::post('/account/update', 'CustomerController@update')->name('account.update')->middleware('customer');
    Route::get('api/get-product', 'SubscriptionController@getProduct')->name('api.get-product')->middleware('customer');
    Route::post('/change-language','HomeController@changeLanguage')->name('changeLanguage');
});

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
    Route::resource('product', 'ProductController')->middleware('admin');
    Route::resource('subscription', 'SubscriptionController')->middleware('admin');

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

Route::post('admin/green-alpha/import-by-drive', 'Admin\GreenAlphaController@importByDrive')->middleware('admin')->name('admin.green-alpha.import-by-drive');
Route::post('admin/green-beta/import-by-drive', 'Admin\GreenBetaController@importByDrive')->middleware('admin')->name('admin.green-beta.import-by-drive');

