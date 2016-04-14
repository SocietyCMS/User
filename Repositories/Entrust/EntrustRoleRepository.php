<?php

namespace Modules\User\Repositories\Entrust;

use Illuminate\Support\Str;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\User\Repositories\RoleRepository;

class EntrustRoleRepository extends EloquentBaseRepository implements RoleRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\User\Entities\Entrust\EloquentRole';
    }

    /**
     * create name before creating a new role instance.
     *
     * @param array $data
     *
     * @return EloquentRole
     */
    public function create(array $data)
    {
        if (!array_key_exists('name', $data)) {
            $data['name'] = Str::slug($data['display_name']);
        }

        return parent::create($data);
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $users
     */
    public function createWithUsers(array $data, $users)
    {
        $role = $this->create((array) $data);

        if (!empty($users)) {
            $role->users()->attach($users);
        }
    }

    /**
     * Create a user and assign roles to it.
     *
     * @param array $data
     * @param array $users
     */
    public function updateWithUsers(array $data, $users, $id)
    {
        $role = $this->update((array) $data, $id);

        if (!empty($users)) {
            $role->users()->sync($users);
        } else {
            $role->users()->detach();
        }
    }

    public function attachPermissions(array $permissions, $id)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findOrFail($id);
        $model = $model->savePermissions($permissions);
        $this->resetModel();

        return $this->parserResult($model);
    }
}
