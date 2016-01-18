<?php
namespace Modules\User\Entities\Entrust;

use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Support\Facades\Config;

class EloquentRole extends Model implements EntrustRoleInterface
{
    use EntrustRoleTrait { hasPermission as entrustHasPermission;}
    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user__roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\RolePresenter';

    /**
     * Many-to-Many relations with the permission model.
     * Named "perms" for backwards compatibility. Also because "perms" is short and sweet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms()
    {
        return $this->belongsToMany(Config::get('entrust.permission'), Config::get('entrust.permission_role_table'), Config::get('entrust.role_foreign_key'), Config::get('entrust.permission_foreign_key'));
    }

    /**
     * Checks if the role has a permission by its name.
     *
     * @param string|array $name       Permission name or array of permission names.
     * @param bool         $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function hasPermission($name, $requireAll = false)
    {
        if($this->name == 'admin')
        {
            return true;
        }
        return $this->entrustHasPermission($name, $requireAll);
    }
}