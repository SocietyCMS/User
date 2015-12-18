<?php

namespace Modules\User\Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SentinelGroupSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $groups = Sentinel::getRoleRepository();

        // Create an Admin group
        $groups->createModel()->create(
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ]
        );

        // Create a Users group
        $groups->createModel()->create(
            [
                'name' => 'User',
                'slug' => 'user',
            ]
        );

        // Save the permissions
        $group = Sentinel::findRoleBySlug('admin');
        $group->permissions = [

            'dashboard.dashboard.index' => true,

            'menu.menu.index' => true,
            'menu.menu.create' => true,
            'menu.menu.store' => true,
            'menu.menu.edit' => true,
            'menu.menu.update' => true,
            'menu.menu.destroy' => true,

            'modules.modules.index' => true,
            'modules.modules.show' => true,
            'modules.modules.create' => true,
            'modules.modules.store' => true,
            'modules.modules.edit' => true,
            'modules.modules.update' => true,
            'modules.modules.destroy' => true,

            'setting.settings.index' => true,
            'setting.settings.create' => true,
            'setting.settings.store' => true,
            'setting.settings.edit' => true,
            'setting.settings.update' => true,
            'setting.settings.destroy' => true,

            'user.users.index' => true,
            'user.users.create' => true,
            'user.users.store' => true,
            'user.users.edit' => true,
            'user.users.update' => true,
            'user.users.destroy' => true,

            'user.roles.index' => true,
            'user.roles.create' => true,
            'user.roles.store' => true,
            'user.roles.edit' => true,
            'user.roles.update' => true,
            'user.roles.destroy' => true,

            'user.profile.show' => true,
            'user.profile.edit' => true,
            'user.profile.update' => true
        ];
        $group->save();

        $group = Sentinel::findRoleBySlug('user');
        $group->permissions = [
            'dashboard.index' => true,
        ];
        $group->save();
    }
}
