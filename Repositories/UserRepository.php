<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\BaseRepository;

/**
 * Interface UserRepository.
 */
interface UserRepository extends BaseRepository
{
    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function createWithRoles(array $data, $roles);

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function updateWithRoles(array $data, $roles, $id);
}
