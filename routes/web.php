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

function sendHome(){
    return Redirect::to('/registration/view');
}

Route::get('/', function () {
    return sendHome();
});

Route::group(array('prefix' => 'registration'), function(){
    Route::get('/', function () {
        return sendHome();
    });
    Route::get('new', 'RegistrationController@registrationForm');
    Route::post('register', 'RegistrationController@register');

    Route::get('view', 'RegistrationController@viewRegistrations');
    Route::get('users/{page?}', 'RegistrationController@getUsers');
});

