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
Route::get('/my_app', function () {
    return view('pages/my_app');
});
Route::get('/main', function () {
    return view('pages/main');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('edit');
    Route::post('/profile', 'ProfileController@update');
    Route::resource('app_cosplay', 'App_cosplayController');
    Route::resource('app_press', 'App_pressController');
    Route::resource('app_fair', 'App_fairController');
    Route::resource('app_volunteer', 'App_volunteerController');
});