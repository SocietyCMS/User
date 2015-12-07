<?php

namespace Modules\User\Entities\Sentinel;

use Cartalyst\Sentinel\Roles\EloquentRole as SentinelRole;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Laracasts\Presenter\PresentableTrait;

class EloquentRole extends SentinelRole implements RoleInterface
{
    use PresentableTrait;

    /**
     * {@inheritdoc}
     */
    protected $table = 'user__roles';

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\RolePresenter';

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$usersModel, 'user__role_users', 'role_id', 'user_id')->withTimestamps();
    }
}
