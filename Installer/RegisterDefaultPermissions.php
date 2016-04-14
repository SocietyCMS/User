<?php

namespace Modules\User\Installer;

class RegisterDefaultPermissions
{
    public $defaultPermissions = [

        'manage-user' => [
            'display_name' => 'user::module-permissions.manage-user.display_name',
            'description'  => 'user::module-permissions.manage-user.description',
        ],

        'manage-role' => [
            'display_name' => 'user::module-permissions.manage-role.display_name',
            'description'  => 'user::module-permissions.manage-role.description',
        ],

        'change-own-profile-picture' => [
            'display_name' => 'user::module-permissions.change-own-profile-picture.display_name',
            'description'  => 'user::module-permissions.change-own-profile-picture.description',
        ],
        'change-own-name' => [
            'display_name' => 'user::module-permissions.change-own-name.display_name',
            'description'  => 'user::module-permissions.change-own-name.description',
        ],
        'change-own-email' => [
            'display_name' => 'user::module-permissions.change-own-email.display_name',
            'description'  => 'user::module-permissions.change-own-email.description',
        ],
        'change-own-contact-info' => [
            'display_name' => 'user::module-permissions.change-own-contact-info.display_name',
            'description'  => 'user::module-permissions.change-own-contact-info.description',
        ],
        'change-own-password' => [
            'display_name' => 'user::module-permissions.change-own-password.display_name',
            'description'  => 'user::module-permissions.change-own-password.description',
        ],

    ];
}
