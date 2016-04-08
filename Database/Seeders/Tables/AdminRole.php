<?php

namespace Modules\User\Database\Seeders\Tables;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Entrust\EloquentUser;

class AdminRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('user__roles')->insertGetId([
            'name' => 'admin',
            'display_name' => 'Site Administrator',
            'description' => 'User is allowed to manage the full site',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
