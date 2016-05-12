<?php

namespace Modules\User\Repositories\Entrust\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SoftDeleteCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->whereNull($model->getQualifiedDeletedAtColumn());

        return $model;
    }
}
