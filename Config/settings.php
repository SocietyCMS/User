<?php

return [

    'user::settings.login.title' => [
        'enable-registration' => [
            'title'       => 'user::settings.login.enable-registration.title',
            'description' => 'user::settings.login.enable-registration.description',
            'type'        => 'boolean',
            'view'        => 'checkbox',
            'default'     => false,
        ],
    ],

    'user::settings.profile.title' => [
        'enable-profile' => [
            'title'       => 'user::settings.profile.enable-profile.title',
            'description' => 'user::settings.profile.enable-profile.description',
            'type'        => 'boolean',
            'view'        => 'checkbox',
            'default'     => true,
        ],
    ],
];
