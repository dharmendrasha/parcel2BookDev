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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('index')->middleware('guest');

//auth index
Route::get('/', function(){
    return  view('logged\welcome');
})->name('authIndex')->middleware('auth');


Route::get('/home', 'HomeController@index')->name('home');

//parcel and pallet book
Route::post('/parcelBook', 'parcelBook@store')->name('parcelBookPost');

//pallet Book
Route::post('/palletBook', 'palletBook@store')->name('palletBookPost');
//parcelBookingStatusControler
Route::get('/awbStatuscheck/{status}/{awb}', 'parcelBookStepsController@new')->name('awbStatusCheck');

//updating the offer
Route::get('/awbStatus/{status}/{awb}/{selectedOffer}', 'parcelBookStepsController@update')->name('statusUpdate');
//updated status edit
Route::get('/awbStatus/{status}/{awb}', 'parcelBookStepsController@edit')->name('statusEdit');
//basicPlan
Route::get('/basicPlan/{awb}', 'chooseOffer@index')->name('basicPlan');
//track awb
Route::post('/awbTrack', 'parcelBookStepsController@track')->name('awbTrack');

//userinfo
Route::get('/userbasicInfo/{awb}', 'userInfoController@index')->name('userInfo');

Route::post('/userbasicInfoSave/{awb}', 'userInfoController@store')->name('userInfoSave');

//userContactInfo
Route::get('/userContact/{status}/{awb}', 'userContactInfoController@index')->name('userContact');
//userContactSave
Route::post('/userContactSave/{status}/{awb}', 'userContactInfoController@store')->name('userContactSave');

Route::get('/userExtraRegistration/{awb}', 'extraRegistrationController@create')->name('extraRegistration');
//
