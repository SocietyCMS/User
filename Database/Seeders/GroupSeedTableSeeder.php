<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Database\Seeders\Tables\AdminRole;

class GroupSeedTableSeeder extends Seeder
{
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

        return $this->call(AdminRole::class);
    }
}
