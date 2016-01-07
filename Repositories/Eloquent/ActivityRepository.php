<?php

namespace Modules\User\Repositories\Eloquent;

use Carbon\Carbon;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class ActivityRepository extends EloquentBaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\\User\\Entities\\Eloquent\\EloquentActivity';
    }

    /**
     * Take the latest records and group by date.
     *
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function latestGroupedByDate($amount = 10)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->latest()->with('subject')->take($amount)->get();
        $this->resetModel();

        return $this->parserResult($model);
    }
}
