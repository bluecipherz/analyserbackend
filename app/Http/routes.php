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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
		
Route::group(array('prefix' => 'api'), function() {
    Route::post('authenticate', 'AuthController@authenticate');
    Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
    Route::get('authenticate/{user?}', 'AuthController@index');

    Route::get('user/{id}', 'UserController@show');
    Route::get('users', 'UserController@index'); 

    // Notification

    Route::post('analyse', 'AnalyticsController@index');
    Route::post('isblocked', 'AnalyticsController@isBlocked');

    Route::post('getapplist', 'AnalyticsController@getAPPList');
    Route::post('changedebuggingmode', 'AnalyticsController@changeDebuggingMode');
    Route::post('getapicalls', 'AnalyticsController@getAPICalls');
    Route::post('registerapicall', 'AnalyticsController@registerAPICalls');
    Route::post('storelocation', 'AnalyticsController@storeLocation');
    Route::post('getlocation', 'AnalyticsController@getLocation');
 
    Route::group(['middleware' => 'jwt.auth'], function() {

    });
        Route::get('employees/{id?}', 'Employees@index');
        Route::post('employees', 'Employees@store');
        Route::post('employees/{id}', 'Employees@update');
        Route::delete('employees/{id}', 'Employees@destroy');

});
