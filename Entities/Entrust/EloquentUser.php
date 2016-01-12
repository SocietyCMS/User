<?php
namespace Modules\User\Entities\Entrust;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laracasts\Presenter\PresentableTrait;

class EloquentUser extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use CanResetPassword;
    use EntrustUserTrait;
    use PresentableTrait;

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
    protected $fillable = ['name', 'email', 'password'];
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

    public function isActivated()
    {
        return true;
    }
}