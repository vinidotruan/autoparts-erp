<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    
    Route::group([
        'prefix' => 'products'
    ], function () {
        Route::get('search', 'ProductController@search');
    });

    Route::group([
        'prefix' => 'categories'
    ], function () {
        Route::get('search', 'CategoriesController@search');
    });

    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('/{user}/notifications', 'UsersController@notifications');
        Route::post('/{user}/notifications/mark-as-read', 'UsersController@markAsRead');
    });
    
    Route::resource('categories','CategoriesController');
    Route::resource('products','ProductController');
    Route::resource('sales','SalesController');
    Route::resource('users','UsersController');
    Route::resource('feeds','FeedsController');
    Route::resource('roles','RolesController');

});

