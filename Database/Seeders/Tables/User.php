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
        DB::table('user__userprofiles')->delete();

        $adminUser = DB::table('user__users')->insertGetId([
            'name' => 'admin',
            'email' => 'admin@societycms.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user__userprofiles')->insert([
            'user_id' => $adminUser,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->factory(\Modules\User\Entities\Entrust\EloquentUser::class, 5)->create()->each(function($user) {
            //$u->posts()->save(factory(App\Post::class)->make());
        });
    }

}