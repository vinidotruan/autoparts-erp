<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'namespace' => 'Auth',
    'prefix' => 'password',
    'middlware' => 'api'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::resource('products','ProductController');
    Route::resource('sales','SalesController');
});

Route::get("update-user/{user}", function(){
    if(Gate::allows("admin-only")){
        return redirect()->action(
            'UsersController@update'
        );
    }
        return json_encode($user->role()->name);
});
