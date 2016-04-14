<?php

namespace Modules\User\Services;

use Modules\Core\Contracts\Authentication;
use Modules\User\Events\UserHasRegistered;
use Modules\User\Repositories\RoleRepository;

/**
 * Class UserRegistration.
 */
class UserRegistration
{
    /**
     * @var Authentication
     */
    private $auth;
    /**
     * @var RoleRepository
     */
    private $role;
    /**
     * @var array
     */
    private $input;

    /**
     * UserRegistration constructor.
     *
     * @param Authentication $auth
     * @param RoleRepository $role
     */
    public function __construct(Authentication $auth, RoleRepository $role)
    {
        $this->auth = $auth;
        $this->role = $role;
    }

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function register(array $input)
    {
        $this->input = $input;

        $user = $this->createUser();

        $this->assignUserToUsersGroup($user);

        event(new UserHasRegistered($user));

        return $user;
    }

    /**
     * @return bool
     */
    private function createUser()
    {
        return $this->auth->register((array) $this->input);
    }

    /**
     * @param $user
     */
    private function assignUserToUsersGroup($user)
    {
        $role = $this->role->findByName('User');

        $this->auth->assignRole($user, $role);
    }
}
