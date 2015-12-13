<?php

return [
    'users' => [
        'index' => [
            'user.users.index',
        ],
        'create' => [
            'user.users.create',
            'user.users.store',
        ],
        'edit' => [
            'user.users.edit',
            'user.users.update',
        ],
        'destroy' => [
            'user.users.destroy',
        ],
    ],
    'roles' => [
        'index' => [
            'user.roles.index',
        ],
        'create' => [
            'user.roles.create',
            'user.roles.store',
        ],
        'edit' => [
            'user.roles.edit',
            'user.roles.update',
        ],
        'destroy' => [
            'user.roles.destroy',
        ],
    ],
    'profile' => [
        'index' => [
            'user.profile.show',
        ],
        'edit' => [
            'user.profile.edit',
            'user.profile.update',
        ],
    ],
];
