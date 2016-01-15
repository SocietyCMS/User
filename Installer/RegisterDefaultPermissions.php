<?php

namespace Modules\User\Installer;

class RegisterDefaultPermissions
{

    public $defaultPermissions = [

        'manage-user' => [
            'display_name' => 'user::module-permissions.manage-user.display_name',
            'description' => 'user::module-permissions.manage-user.description'
        ],

        'manage-role' => [
            'display_name' => 'user::module-permissions.manage-role.display_name',
            'description' => 'user::module-permissions.manage-role.description'
        ],

    ];
}
