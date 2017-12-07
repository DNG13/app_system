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
Route::get('/', function () {
    return view('pages/main');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update');
    Route::match(['get', 'post'],'cosplay', 'AppCosplayController@index')->name('cosplay.index');
    Route::post('cosplay/store', 'AppCosplayController@store');
    Route::resource('cosplay', 'AppCosplayController', ['except' => ['index', 'store']]);
    Route::match(['get', 'post'],'press', 'AppPressController@index')->name('press.index');
    Route::post('press/store', 'AppPressController@store');
    Route::resource('press', 'AppPressController', ['except' => ['index',  'store']]);
    Route::match(['get', 'post'],'fair', 'AppFairController@index')->name('fair.index');
    Route::post('fair/store', 'AppFairController@store');
    Route::resource('fair', 'AppFairController', ['except' => ['index', 'store']]);
    Route::resource('volunteer', 'AppVolunteerController');
    Route::resource('type', 'AddTypeController', ['except' => ['show', 'destroy']]);
    Route::get('/type/delete', 'AddTypeController@destroy');
    Route::post('/comment/create', 'CommentController@create');
    Route::get('/comment/delete', 'CommentController@delete');
});