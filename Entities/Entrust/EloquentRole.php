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
