<?php

namespace Modules\User\Entities\Sentinel;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;
use Illuminate\Support\Facades\Config;
use Laracasts\Presenter\PresentableTrait;
use Modules\User\Entities\UserInterface;

/**
 * Class EloquentUser.
 */
class EloquentUser extends SentinelUser implements UserInterface
{
    use PresentableTrait;

    /**
     * {@inheritdoc}
     */
    protected $table = 'user__users';

    /**
     * {@inheritdoc}
     */
    protected $persistableRelationship = 'user__persistences';

    /**
     * The Eloquent roles model name.
     *
     * @var string
     */
    protected static $rolesModel = 'Modules\User\Entities\Sentinel\EloquentRole';

    /**
     * The Eloquent persistences model name.
     *
     * @var string
     */
    protected static $persistencesModel = 'Modules\User\Entities\Sentinel\EloquentPersistence';

    /**
     * The Eloquent activations model name.
     *
     * @var string
     */
    protected static $activationsModel = 'Modules\User\Entities\Sentinel\EloquentActivation';

    /**
     * The Eloquent reminders model name.
     *
     * @var string
     */
    protected static $remindersModel = 'Modules\User\Entities\Sentinel\EloquentReminder';

    /**
     * The Eloquent throttling model name.
     *
     * @var string
     */
    protected static $throttlingModel = 'Modules\User\Entities\Sentinel\EloquentThrottle';

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\UserPresenter';

    /**
     * The fillable properties of the model.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
    ];

    /**
     * The hidden properties of the model.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'permissions',
    ];

    /**
     * {@inheritdoc}
     */
    protected $loginNames = ['email'];

    /**
     * Returns the roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(static::$rolesModel, 'user__role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * EloquentUser constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->loginNames = config('society.user.config.login-columns');
    }

    /**
     * Checks if a user belongs to the given Role ID.
     *
     * @param int $roleId
     *
     * @return bool
     */
    public function hasRoleId($roleId)
    {
        return $this->roles()->whereId($roleId)->count() >= 1;
    }

    /**
     * Checks if a user belongs to the given Role Name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasRoleName($name)
    {
        return $this->roles()->whereName($name)->count() >= 1;
    }

    /**
     * Returns the activity relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function activity()
    {
        return $this->hasMany('Modules\User\Entities\Eloquent\EloquentActivity');
    }

    /**
     * Returns the profile relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profile()
    {
        return $this->hasOne('Modules\User\Entities\Eloquent\EloquentUserProfile', 'user_id');
    }

    /**
     * Check if the current user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        if ($activation = Activation::completed($this)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $class_name = class_basename($this);

        #i: Convert array to dot notation
        $config = implode('.', ['relations', $class_name, $method]);

        #i: Relation method resolver
        if (Config::has($config)) {
            $function = Config::get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
