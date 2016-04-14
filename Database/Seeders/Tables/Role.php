<?php

namespace Modules\User\Database\Seeders\Tables;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Entrust\EloquentUser;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user__roles')->delete();

        $admin = DB::table('user__roles')->insertGetId([
            'name'         => 'admin',
            'display_name' => 'Site Administrator',
            'description'  => 'User is allowed to manage the full site',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),

        ]);

        $user = EloquentUser::where('email', '=', 'admin@societycms.com')->first();

        $user->roles()->attach($admin);

        DB::table('user__roles')->insert([
            'name'         => 'owner',
            'display_name' => 'Project Owner',
            'description'  => 'User is the owner of a given project',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);
    }
}
