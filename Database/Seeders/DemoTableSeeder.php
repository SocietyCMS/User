<?php

namespace Modules\User\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Factory\useFactories;
use Modules\User\Entities\Entrust\EloquentUser;
use Modules\User\Entities\Entrust\EloquentRole;

class DemoTableSeeder extends Seeder
{
    use useFactories;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('user__users')->delete();
        DB::table('user__roles')->delete();
        DB::table('user__password_resets')->delete();
        DB::table('user__activities')->delete();
        DB::table('user__role_user')->delete();
        DB::table('user__permissions')->delete();
        DB::table('user__permission_role')->delete();

        $this->createAdmin();
        $this->createUsers();
    }

    private function createAdmin()
    {
        $faker = \Faker\Factory::create();
        $adminUserInfo = [
            'first_name' => 'SocietyCMS',
            'last_name' => 'Administrator',
            'email' => 'admin@societycms.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'title' => $faker->title,
            'office' => $faker->company,
            'bio' => $faker->paragraph,
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'last_login' => $faker->dateTimeThisYear,
        ];
        
        $adminRoleInfo = [
            'name' => 'admin',
            'display_name' => 'Site Administrator',
            'description' => 'User is allowed to manage the full site',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $adminUser = (new EloquentUser())->create($adminUserInfo);
        $adminRole = (new EloquentRole())->create($adminRoleInfo);
        $adminUser->attachRole($adminRole);
    }

    private function createUsers()
    {
        $this->factory(\Modules\User\Entities\Entrust\EloquentUser::class, 50)->create();
    }
}