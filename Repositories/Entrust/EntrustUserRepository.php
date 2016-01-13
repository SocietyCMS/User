<?php

namespace Modules\User\Repositories\Entrust;


use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\User\Repositories\UserRepository;

class EntrustUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\User\Entities\Entrust\EloquentUSer';
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function createWithRoles($data, $roles)
    {
        $user = $this->create((array) $data);

        if (!empty($roles)) {
            $user->roles()->attach($roles);
        }
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function updateWithRoles($data, $roles, $id)
    {
        $user = $this->update((array) $data, $id);

        if (!empty($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }
    }
}
