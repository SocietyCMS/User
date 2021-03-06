<?php

namespace Modules\User\Entities\Entrust;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Activity\RecordsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class EloquentUser extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasMediaConversions
{
    use Authenticatable;
    use CanResetPassword;
    use PresentableTrait;
    use RecordsActivity;
    use SoftDeletes;

    use HasMediaTrait;

    use EntrustUserTrait {
        can as entrustCan;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user__users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'office',
        'bio',
        'street',
        'city',
        'zip',
        'country',
        'phone',
        'mobile',
        'password',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\UserPresenter';

    /**
     * Returns the activity relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function activity()
    {
        return $this->hasMany('Modules\Core\Entities\Eloquent\Activity');
    }

    /**
     * @var array
     */
    protected static $recordEvents = ['created'];

    /**
     * Views for the Dashboard timeline.
     *
     * @var string
     */
    protected static $templatePath = 'user::backend.activities';

    /**
     * Privacy setting for the dashboard. Only show users to logged in users.
     *
     * @var string
     */
    protected static $activityPrivacy = 'protected';

    public function registerMediaConversions()
    {
        $this->addMediaConversion('square')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original180')
            ->setManipulations(['w' => 180, 'h' => 180, 'fit' => 'max'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original250')
            ->setManipulations(['w' => 250, 'h' => 250, 'fit' => 'max'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original400')
            ->setManipulations(['w' => 400, 'h' => 400, 'fit' => 'max'])
            ->performOnCollections('profile');
    }

    /**
     * Check if user has a permission by its name.
     * return rearly if the user is in the admin group.
     *
     * @param string|array $permission Permission string or array of permissions.
     * @param bool $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if ($this->cachedRoles()->where('name', 'admin')->count()) {
            return true;
        }

        return $this->entrustCan($permission, $requireAll = false);
    }
}
