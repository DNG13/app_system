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
Route::get('/', function () {
    return view('pages/main');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('edit');
    Route::post('/profile', 'ProfileController@update');
    Route::resource('cosplay', 'AppCosplayController');
    Route::resource('press', 'App_pressController');
    Route::resource('fair', 'App_fairController');
    Route::resource('volunteer', 'App_volunteerController');
    Route::get('/my_app', function () {
        return view('pages/my_app');
    });
});