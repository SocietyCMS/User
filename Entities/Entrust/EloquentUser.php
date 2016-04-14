<?php

namespace Modules\User\Entities\Entrust;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class EloquentUser extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasMediaConversions
{
    use Authenticatable;
    use CanResetPassword;
    use PresentableTrait;

    use HasMediaTrait{ delete as mediaDelete; }

    use EntrustUserTrait { can as entrustCan; delete as entrustDelete; }

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
        return $this->hasMany('Modules\User\Entities\Eloquent\EloquentActivity');
    }

    public function isActivated()
    {
        return true;
    }

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
     * @param bool         $requireAll All permissions in the array are required.
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

    /**
     * Delete the model. The extra logic isn't handled in a model event since the boot function is unreliable
     * for currently unknown reasons.
     *
     * @return bool
     */
    public function delete()
    {
        $this->mediaDelete();
        $this->entrustDelete();

        return true;
    }
}
