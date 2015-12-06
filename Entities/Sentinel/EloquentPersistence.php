<?php namespace Modules\User\Entities\Sentinel;


use Cartalyst\Sentinel\Persistences\EloquentPersistence as SentinelPersistence;
use Cartalyst\Sentinel\Persistences\PersistenceInterface;

class EloquentPersistence extends SentinelPersistence implements PersistenceInterface
{

    /**
     * {@inheritDoc}
     */
    protected $table = 'user__persistences';

    /**
     * The users model name.
     *
     * @var string
     */
    protected static $usersModel = 'Modules\User\Entities\Sentinel\User';
}
