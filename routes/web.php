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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home')->middleware('subscribed');

Route::get('subscriptions/create', 'SubscriptionController@create')->name('subscription.create')->middleware('auth');
Route::post('subscriptions/cancel', 'SubscriptionController@cancel')->name('subscription.cancel')->middleware('auth');

Route::post('payment/process', 'PaymentController@process')->name('payment.process')->middleware('auth');




Route::middleware(['admin'])->namespace('Admin') -> group(function (){

    Route::get('admin/users', 'UserController@index' )->name('admin.users.index');

});
