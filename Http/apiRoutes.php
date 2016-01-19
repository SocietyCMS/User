<?php

$api->version('v1', function ($api) {
    $api->group([
        'prefix'     => 'user',
        'namespace'  => $this->namespace.'\api',
        'middleware' => config('society.core.core.middleware.api.backend', []),
        'providers'  => ['jwt'],
    ], function ($api) {

        $api->resource('user', 'UserController', ['only' => ['index','store', 'update', 'destroy']]);

        $api->post('profile/{profile}', ['middleware' => ['permission:user::change-own-profile-picture'], 'as' => 'api.user.profile.store', 'uses' => 'ProfileController@store']);
    });
});
