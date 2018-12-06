<?php

// todo: logout -> auth/logout
Route::post('logout', 'AuthController@logout');

Route::post('users', 'UserController@create');
Route::post('auth/check', 'AuthController@test');
Route::post('auth/refresh', 'AuthController@refresh');

Route::get('users', 'UserController@search');
Route::delete('users/{user}', 'UserController@delete');

Route::post('codes/create', 'CodeController@create');
Route::post('codes/search', 'CodeController@search');
Route::post('codes/update', 'CodeController@update');
Route::post('codes/delete', 'CodeController@delete');

Route::post('tasks/create', 'TaskController@create');
Route::post('tasks/search', 'TaskController@search');
Route::post('tasks/update', 'TaskController@update');
Route::post('tasks/delete', 'TaskController@delete');
Route::post('tasks/{id}', 'TaskController@getById');
