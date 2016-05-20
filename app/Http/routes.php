<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
////    return view('welcome');
//    return view('pages.home');
//});
//
//Route::resource('flyers', 'FlyersController');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


//Route::get('/', function () {
//    return view('pages.home');
//});

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'PagesController@home');

// Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');


// Flyer routes
    Route::resource('flyers', 'FlyersController');
    Route::get('{zip}/{street}', 'FlyersController@show');
//    Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'FlyersController@addPhoto']);
    Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'PhotosController@store']);

    Route::delete('photos/{id}', 'PhotosController@destroy');

});
