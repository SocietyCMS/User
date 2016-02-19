<?php
namespace Modules\User\Entities\Entrust;

use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;
use Illuminate\Database\Eloquent\Model;
use Config;

class EloquentPermission extends Model implements EntrustPermissionInterface
{
    use EntrustPermissionTrait { roles as entrustRoles;}

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user__permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'module',
    ];

    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.permission_role_table'),Config::get('entrust.permission_foreign_key'), Config::get('entrust.role_foreign_key'));
    }
}