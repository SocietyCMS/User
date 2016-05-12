<?php

namespace Modules\User\Entities;

interface UserInterface
{
    /**
     * Checks if a user belongs to the given Role ID.
     *
     * @param int $roleId
     *
     * @return bool
     */
    public function hasRoleId($roleId);

    /**
     * Checks if a user belongs to the given Role Name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasRoleName($name);
    
    /**
     * Implement presenter.
     *
     * @return mixed
     */
    public function present();
}
