<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\BaseRepository;

/**
 * Interface RoleRepository.
 */
interface RoleRepository extends BaseRepository
{
    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function createWithUsers(array $data, $users);

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function updateWithUsers(array $data, $users, $id);
}
