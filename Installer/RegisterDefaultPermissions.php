<?php

namespace Modules\User\Installer;

class RegisterDefaultPermissions
{

    public $defaultPermissions = [

        'manage-user' => [
            'display_name' => 'user::permissions.manage-user.display_name',
            'description' => 'user::permissions.manage-user.description'
        ],

        'manage-role' => [
            'display_name' => 'user::permissions.manage-role.display_name',
            'description' => 'user::permissions.manage-role.description'
        ],

    ];
}
