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
Route::get('/user/activation/{id}/{code}', 'Auth\RegisterController@userActivation');
Route::get('auth/reactivate', 'Auth\RegisterController@userReactivation')->name('reactivate');
Route::post('auth/reactivate/send', 'Auth\RegisterController@userReactivationSend')->name('reactivate.send');

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
Route::post('auth/profile', 'Auth\RegisterController@profileFacebook');
Route::get('storage/{userId}/avatar', 'ProfileController@getAvatar');

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update');
    Route::match(['get', 'post'],'cosplay', 'AppCosplayController@index')->name('cosplay.index');
    Route::post('cosplay/store', 'AppCosplayController@store');
    Route::resource('cosplay', 'AppCosplayController', ['except' => ['index', 'store', 'destroy']])->middleware('check.profile');
    Route::match(['get', 'post'],'press', 'AppPressController@index')->name('press.index');
    Route::post('press/store', 'AppPressController@store');
    Route::resource('press', 'AppPressController', ['except' => ['index',  'store', 'destroy']])->middleware('check.profile');
    Route::match(['get', 'post'],'fair', 'AppFairController@index')->name('fair.index');
    Route::post('fair/store', 'AppFairController@store');
    Route::resource('fair', 'AppFairController', ['except' => ['index', 'store', 'destroy']])->middleware('check.profile');
    Route::resource('volunteer', 'AppVolunteerController', ['except' => 'destroy'])->middleware('check.profile');
    Route::post('/comment/create', 'CommentController@create');
    Route::post('/upload', 'FileController@upload');
    Route::get('storage/{file_id}', 'FileController@getFile');
    Route::get('storage/{file_id}/thumbnail', 'FileController@getThumbnail');
});


Route::group(['middleware' => ['role.admin']], function() {
    Route::get('create-zip', 'FileController@zip')->name('create-zip');
    Route::resource('type', 'AddTypeController', ['except' => ['show', 'destroy']]);
    Route::get('/type/delete', 'AddTypeController@destroy');
    Route::resource('role', 'AddRoleController', ['except' => ['show', 'destroy']]);
    Route::get('/role/delete', 'AddRoleController@destroy');
    Route::resource('user-role', 'UserRoleController', ['except' => ['show', 'destroy', 'create', 'store']]);
    Route::get('/profile/{profile}', 'ProfileController@show');
    Route::get('/file/delete', 'FileController@destroy');
    Route::get('/comment/delete', 'CommentController@destroy');
});