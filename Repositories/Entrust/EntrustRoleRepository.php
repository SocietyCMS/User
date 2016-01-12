<?php

namespace Modules\User\Repositories\Entrust;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\User\Repositories\RoleRepository;

class EntrustRoleRepository extends EloquentBaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\User\Entities\Entrust\EloquentRole';
    }
}