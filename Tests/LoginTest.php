<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Core\Traits\Testing\DatabaseMigrations;
use Modules\Core\Traits\Testing\MigrateSocietyCMSDemo;

class LoginTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MigrateSocietyCMSDemo;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function tests_if_user_can_login()
    {
        $this->visit('/')
            ->see('Login')
            ->click('Login')

            ->type('admin@societycms.com', 'email')
            ->type('secret', 'password')
            ->press('Sign in')

            ->seePageIs('/backend')
            ->see('Welcome to SocietyCMS');
    }
}
