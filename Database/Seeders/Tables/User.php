<?php

namespace Modules\User\Database\Seeders\Tables;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Factory\useFactories;

class User extends Seeder
{
    use useFactories;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user__users')->delete();

        $faker = \Faker\Factory::create('de_CH');

        $adminUser = DB::table('user__users')->insert([
            'first_name' => 'SocietyCMS',
            'last_name' => 'Administrator',
            'email' => 'admin@societycms.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'title' => $faker->title,
            'description' => $faker->sentence,
            'office' => $faker->company,
            'bio' => $faker->paragraph,
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'last_login' => $faker->dateTimeThisYear,
        ]);

        $this->factory(\Modules\User\Entities\Entrust\EloquentUser::class, 50)->create();
    }

}
