<?php

namespace Modules\User\Composers;

use Modules\User\Repositories\Entrust\Criteria\RoleOrderCriteria;
use Modules\User\Repositories\RoleRepository;

class RoleListComposer
{
    /**
     * @var UserRepository
     */
    private $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function compose($view)
    {
        $this->role->pushCriteria(new RoleOrderCriteria());
        $view->roles = $this->role->all();
    }
}
