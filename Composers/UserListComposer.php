<?php

namespace Modules\User\Composers;

use Modules\User\Repositories\Entrust\Criteria\UserOrderCriteria;
use Modules\User\Repositories\UserRepository;

class UserListComposer
{
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function compose($view)
    {
        $this->user->pushCriteria(new UserOrderCriteria());
        $view->users = $this->user->all();
    }
}
