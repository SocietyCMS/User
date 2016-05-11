<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'auth'], function (Router $router) {
    // Login
    $router->get('login', ['middleware' => 'auth.guest', 'as' => 'login', 'uses' => 'AuthController@getLogin']);
    $router->post('login', ['as' => 'login.post', 'uses' => 'AuthController@postLogin']);

    // Register
    $router->get('register',
        ['middleware' => 'auth.guest', 'as' => 'register', 'uses' => 'AuthController@getRegister']);
    $router->post('register', ['as' => 'register.post', 'uses' => 'AuthController@postRegister']);

    // Account Activation
    $router->get('activate/{userId}/{activationCode}', 'AuthController@getActivate');

    // Password reset link request routes...
    $router->get('password/email', ['as' => 'reset', 'uses' => 'PasswordController@getEmail']);
    $router->post('password/email', ['as' => 'reset.post', 'uses' => 'PasswordController@postEmail']);
    // Password reset routes...
    $router->get('password/reset/{token}', ['as' => 'reset.complete', 'uses' => 'PasswordController@getReset']);
    $router->post('password/reset', ['as' => 'reset.complete.post', 'uses' => 'PasswordController@postReset']);

    // Logout
    $router->get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
});
