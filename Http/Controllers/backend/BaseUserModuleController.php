<?php

namespace Modules\User\Http\Controllers\backend;

use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\Core\Permissions\PermissionManager;

abstract class BaseUserModuleController extends AdminBaseController
{
    /**
     * @var PermissionManager
     */
    protected $permissions;

    public function __construct()
    {
        parent::__construct();
        $this->permissions = new PermissionManager();
    }

    /**
     * @param $request
     *
     * @return array
     */
    protected function mergeRequestWithPermissions($request)
    {
        return array_merge($request->all(), ['permissions' => $this->permissions->clean($request->permissions)]);
    }
}
