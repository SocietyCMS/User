<?php namespace Modules\User\Entities\Sentinel;

use Cartalyst\Sentinel\Throttling\EloquentThrottle as SentinelThrottle;

class EloquentThrottle extends SentinelThrottle
{

    /**
     * {@inheritDoc}
     */
    protected $table = 'user__throttle';
}
