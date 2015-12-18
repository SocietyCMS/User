<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Modules\Core\Traits\Testing\DatabaseMigrations;
use Modules\Modules\Manager\ModuleManager;

class LoginTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function tests_if_user_can_login()
    {
        $this->visit('/')
            ->see('Sign in')
            ->click('Sign in')

            ->type('admin@societycms.com', 'email')
            ->type('test', 'password')
            ->press('Sign in')

            ->seePageIs('/backend')
            ->see('SocietyCMS Admin Interface');
    }
}
