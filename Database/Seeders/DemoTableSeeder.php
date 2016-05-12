<?php

namespace Modules\User\Database\Seeders;

use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Factory\useFactories;
use Modules\User\Entities\Entrust\EloquentRole;
use Modules\User\Entities\Entrust\EloquentUser;

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
        DB::table('user__role_user')->delete();
        DB::table('user__permissions')->delete();
        DB::table('user__permission_role')->delete();

        $this->createAdmin();
        $this->createDemo();

        $this->createUsers();
    }

    private function createAdmin()
    {
        $faker = \Faker\Factory::create();
        $adminUserInfo = [
            'first_name' => 'SocietyCMS',
            'last_name'  => 'Administrator',
            'email'      => 'admin@societycms.com',
            'password'   => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'title'      => $faker->title,
            'office'     => $faker->company,
            'bio'        => $faker->paragraph,
            'street'     => $faker->streetAddress,
            'city'       => $faker->city,
            'zip'        => $faker->postcode,
            'country'    => $faker->country,
            'phone'      => $faker->phoneNumber,
            'mobile'     => $faker->phoneNumber,
            'last_login' => $faker->dateTimeThisYear,
        ];

        $adminRoleInfo = [
            'name'         => 'admin',
            'display_name' => 'Site Administrator',
            'description'  => 'User is allowed to manage the full site',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];

        $adminUser = (new EloquentUser())->create($adminUserInfo);
        $adminRole = (new EloquentRole())->create($adminRoleInfo);
        $adminUser->attachRole($adminRole);
    }

    private function createDemo()
    {
        $faker = \Faker\Factory::create();
        $demoUserInfo = [
            'first_name' => 'Demo',
            'last_name'  => 'User',
            'email'      => 'demo@societycms.com',
            'password'   => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'title'      => $faker->title,
            'office'     => $faker->company,
            'bio'        => $faker->paragraph,
            'street'     => $faker->streetAddress,
            'city'       => $faker->city,
            'zip'        => $faker->postcode,
            'country'    => $faker->country,
            'phone'      => $faker->phoneNumber,
            'mobile'     => $faker->phoneNumber,
            'last_login' => $faker->dateTimeThisYear,
        ];

        $demoRoleInfo = [
            'name'         => 'demo',
            'display_name' => 'User Group',
            'description'  => 'Unprivileged User',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];

        $demoUser = (new EloquentUser())->create($demoUserInfo);
        $demoRole = (new EloquentRole())->create($demoRoleInfo);
        $demoUser->attachRole($demoRole);
    }

    private function createUsers()
    {
        $this->factory(\Modules\User\Entities\Entrust\EloquentUser::class, 50)->create()
            ->each(function ($user) {
                $faker = Factory::create();
                $activity = $user->activities->first();
                if($activity) {
                    $activity->update([
                        'created_at' => $start = $faker->dateTimeThisYear,
                        'updated_at' => $faker->dateTimeBetween($start),
                    ]);
                }
            });
    }
}
