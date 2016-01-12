<?php
namespace Modules\User\Entities\Entrust;

use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class EloquentRole extends Model implements EntrustRoleInterface
{
    use EntrustRoleTrait;
    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user__roles';

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\RolePresenter';
}