<?php

use Illuminate\Http\Request;







Route::group([
    'middleware' => 'api'
], function ($router) {

    // Projects
    Route::get('projects_types/{type_id}' , 'Api\ProjectTypeController@parameters');
    Route::get('projects_types' , 'Api\ProjectTypeController@index');

    // Projects
    Route::get('projects/customer/{project_id}' , 'Api\ProjectController@get');
    Route::get('projects/customer' , 'Api\ProjectController@customer');
    Route::get('projects/add' , 'Api\ProjectController@add');

	Route::post('projects/pay' , 'Api\ProjectController@pay');

    Route::resource('users', 'Api\SuperAdmin\UsersController');
    Route::resource('testing', 'Api\DialogsController@test');

    // Auth
    Route::get('auth/profile/{login?}', 'AuthController@profile');
    Route::get('auth/refresh', 'AuthController@refresh');
    Route::post('auth/profile', 'AuthController@update');
    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/signup', 'AuthController@signup');
    Route::post('auth/logout', 'AuthController@logout');

    // Menus
    Route::get('menu', 'Api\MenuController@index');
    Route::get('menu_test', 'Api\MenuController@index_tmp');

    // Messages
    Route::get('dialogs', 'Api\DialogsController@index');
    Route::get('dialogs/{dialog_id}', 'Api\DialogsController@get');
    Route::post('dialogs/{dialog_id?}', 'Api\DialogsController@create');

    // Users
    Route::get('users', 'Api\UsersController@index');
    Route::get('user','Api\UsersController@getUser');
});




// test
// Route::resource('test', 'Api\IndexController');


// admin
// Route::resource('menus', 'Api\Admin\IndexController');
// Route::get('languages', 'Api\Admin\IndexController@languages');


// super_admin
// Route::post('settings_names', 'Api\SuperAdmin\SettingsNamesController@settings_names');
// Route::post('settings_values', 'Api\SuperAdmin\SettingsNamesController@settings_values');
// Route::get('settings_name/languages', 'Api\SuperAdmin\SettingsNamesController@languages');
// Route::get('settings_name/{id}', 'Api\SuperAdmin\SettingsNamesController@show');
// Route::post('settings_name/create', 'Api\SuperAdmin\SettingsNamesController@store');
// Route::put('settings_name/{id}', 'Api\SuperAdmin\SettingsNamesController@update');
// Route::delete('settings_name/{id}', 'Api\SuperAdmin\SettingsNamesController@destroy');




// Route::get('settings_value/{id}', 'Api\SuperAdmin\SettingsValuesController@show');
// Route::post('settings_value/create', 'Api\SuperAdmin\SettingsValuesController@store');
// Route::put('settings_value/{id}', 'Api\SuperAdmin\SettingsValuesController@update');
// Route::delete('settings_value/{id}', 'Api\SuperAdmin\SettingsValuesController@destroy');



