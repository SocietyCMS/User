<?php

namespace Modules\User\Repositories\Entrust\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RoleOrderCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->orderBy('display_name', 'asc');

        return $model;
    }
}
