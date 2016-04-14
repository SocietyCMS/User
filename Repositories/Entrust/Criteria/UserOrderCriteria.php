<?php

namespace Modules\User\Repositories\Entrust\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UserOrderCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');

        return $model;
    }
}
