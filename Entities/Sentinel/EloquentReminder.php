<?php namespace Modules\User\Entities\Sentinel;



use Cartalyst\Sentinel\Reminders\EloquentReminder as SentinelReminder;

class EloquentReminder extends SentinelReminder
{

    /**
     * {@inheritDoc}
     */
    protected $table = 'user__reminders';
}
