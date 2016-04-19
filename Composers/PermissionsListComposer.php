<?php

namespace Modules\User\Composers;

use Modules\Core\Permissions\PermissionManager;

class PermissionsListComposer
{
    /**
     * @var PermissionManager
     */
    private $permissions;

    public function __construct(PermissionManager $permissions)
    {
        $this->permissions = $permissions;
    }

    public function compose($view)
    {
        $view->permissions = $this->permissions->allManagedPermissions();
    }
}
