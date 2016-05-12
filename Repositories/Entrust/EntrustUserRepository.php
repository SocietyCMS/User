<?php

namespace Modules\User\Repositories\Entrust;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\User\Repositories\Entrust\Criteria\SoftDeleteCriteria;
use Modules\User\Repositories\UserRepository;

class EntrustUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\User\Entities\Entrust\EloquentUser';
    }
    
    /**
     * Encrypt password before creating a new user instance.
     *
     * @param array $data
     *
     * @return EloquentUser
     */
    public function create(array $data)
    {
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }

        return parent::create($data);
    }

    /**
     * Encrypt password before updating a user instance.
     *
     * @param array $data
     *
     * @return EloquentUser
     */
    public function update(array $data, $id)
    {
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }

        return parent::update($data, $id);
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     *
     * @return EloquentUser
     */
    public function createWithRoles(array $data, $roles)
    {
        $user = $this->create((array) $data);

        if (! empty($roles)) {
            $user->roles()->attach($roles);
        }

        return $user;
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $roles
     */
    public function updateWithRoles(array $data, $roles, $id)
    {
        $user = $this->update((array) $data, $id);

        if (! empty($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }
    }
}
