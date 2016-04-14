<?php

namespace Modules\User\Traits\Activity;

use Carbon\Carbon;
use Modules\User\Entities\Eloquent\EloquentActivity;
use Modules\User\Entities\Eloquent\EloquentActivity as Activity;

/**
 * Class RecordsActivity.
 */
trait RecordsActivity
{
    /**
     * Boot the trait.
     */
    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    /**
     * @param $model
     * @param $event
     */
    public function recordActivity($event)
    {
        $mapping = [
            'subject_id'   => $this->id,
            'subject_type' => get_class($this),
            'name'         => $this->getActivityName($this, $event),
            'user_id'      => $this->user_id,
            'template'     => $this->getTemplate(),
        ];

        $recentSimilar = Activity::where($mapping)
            ->where('created_at', '>=', Carbon::now()->subMinutes(30))
            ->count();

        if ($recentSimilar == 0) {
            Activity::create($mapping);
        }
    }

    /**
     * @param $model
     * @param $action
     *
     * @return string
     */
    protected function getActivityName($model, $action)
    {
        $name = strtolower((new \ReflectionClass($model))->getShortName());

        return "{$action}_{$name}";
    }

    /**
     * @return string
     */
    protected function getTemplate()
    {
        if (isset(static::$templatePath)) {
            return static::$templatePath;
        }

        return '';
    }

    /**
     * Default records activity created and updated.
     *
     * @return array
     */
    protected static function getModelEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created', 'updated',
        ];
    }

    /**
     * Get all of the owning Activity models.
     */
    public function activities()
    {
        return $this->morphMany(EloquentActivity::class, 'subject');
    }
}
