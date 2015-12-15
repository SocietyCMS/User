<?php

$router->group(['prefix' => '/user'], function () {
    get('users', ['as' => 'backend::user.user.index', 'uses' => 'UserController@index']);
    get('users/create', ['as' => 'backend::user.user.create', 'uses' => 'UserController@create']);
    post('users', ['as' => 'backend::user.user.store', 'uses' => 'UserController@store']);
    get('users/{users}/edit', ['as' => 'backend::user.user.edit', 'uses' => 'UserController@edit']);
    put('users/{users}/edit', ['as' => 'backend::user.user.update', 'uses' => 'UserController@update']);
    delete('users/{users}', ['as' => 'backend::user.user.destroy', 'uses' => 'UserController@destroy']);

    get('roles', ['as' => 'backend::user.role.index', 'uses' => 'RolesController@index']);
    get('roles/create', ['as' => 'backend::user.role.create', 'uses' => 'RolesController@create']);
    post('roles', ['as' => 'backend::user.role.store', 'uses' => 'RolesController@store']);
    get('roles/{roles}/edit', ['as' => 'backend::user.role.edit', 'uses' => 'RolesController@edit']);
    put('roles/{roles}/edit', ['as' => 'backend::user.role.update', 'uses' => 'RolesController@update']);
    delete('roles/{roles}', ['as' => 'backend::user.role.destroy', 'uses' => 'RolesController@destroy']);

    get('profile/', ['as' => 'backend::user.profile.show', 'uses' => 'ProfileController@currentUser']);
    get('profile/{id}/edit', ['as' => 'backend::user.profile.edit', 'uses' => 'ProfileController@edit']);

    put('profile/{id}/edit/password', ['as' => 'backend::user.profile.update.password', 'uses' => 'ProfileController@updatePassword']);
});
