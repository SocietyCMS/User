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
}