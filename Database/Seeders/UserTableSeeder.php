<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('Modules\\User\\Database\\Seeders\\SentinelGroupSeedTableSeeder');
        $this->call('Modules\\User\\Database\\Seeders\\SentinelUserSeedTableSeeder');
    }
}
