<?php

namespace Modules\User\Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user__users')->insert([
            'name' => 'admin',
            'email' => 'admin@societycms.com',
            'password' => bcrypt('secret'),
        ]);
    }
}