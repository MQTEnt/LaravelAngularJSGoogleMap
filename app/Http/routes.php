<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('checkDatabase',function(){
	return DB::connection()->getDatabaseName();
});
Route::get('checkView',function(){
	return Auth::user()->id;
});

//Route App

//Place
//List and edit place
Route::get('place/getList',['as'=>'place.getList','uses'=>'PlacesController@getList']);
Route::get('place/index',['as'=>'place.index','uses'=>'PlacesController@index']);
Route::post('place/{id}/update',['as'=>'place.update','uses'=>'PlacesController@update']);
//Create and store place
Route::get('place/create',['as'=>'place.create','uses'=>'PlacesController@create']);
Route::post('place/store',['as'=>'place.store','uses'=>'PlacesController@store']);
//Delete place
Route::get('place/{id}/delete',['as'=>'place.destroy','uses'=>'PlacesController@delete']);

//User
//Login & Logout
Route::get('login',['as'=>'getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('login',['as'=>'postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('logout',['as'=>'getLogout','uses'=>'Auth\AuthController@getLogout']);
//Register
Route::get('register',['as'=>'getRegister','uses'=>'Auth\AuthController@getRegister']);
Route::post('register',['as'=>'postRegister','uses'=>'Auth\AuthController@postRegister']);

//Review place
Route::post('review/store',['as'=>'review.store','uses'=>'ReviewsController@store']);
Route::get('bestReviews/{place_id}',['as'=>'review.best','uses'=>'ReviewsController@best']);