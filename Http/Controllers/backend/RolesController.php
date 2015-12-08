<?php

namespace Modules\User\Http\Controllers\backend;

use Modules\Core\Permissions\PermissionManager;
use Modules\User\Http\Requests\RolesRequest;
use Modules\User\Repositories\RoleRepository;

class RolesController extends BaseUserModuleController
{
    /**
     * @var RoleRepository
     */
    private $role;

    public function __construct(PermissionManager $permissions, RoleRepository $role)
    {
        parent::__construct();

        $this->permissions = $permissions;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->role->all();

        return view('user::backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user::backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RolesRequest $request
     *
     * @return Response
     */
    public function store(RolesRequest $request)
    {
        $data = $this->mergeRequestWithPermissions($request);

        if($this->role->create($data)) {
            flash(trans('user::messages.role created'));
        }

        return redirect()->route('backend::user.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (!$role = $this->role->find($id)) {
            flash()->error(trans('user::messages.role not found'));

            return redirect()->route('backend::user.role.index');
        }

        return view('user::backend.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int          $id
     * @param RolesRequest $request
     *
     * @return Response
     */
    public function update($id, RolesRequest $request)
    {
        $data = $this->mergeRequestWithPermissions($request);

        $this->role->updateAndSyncUsers($id, $data, $request->users);

        flash(trans('user::messages.role updated'));

        return redirect()->route('backend::user.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->role->delete($id);

        flash(trans('user::messages.role deleted'));

        return redirect()->route('backend::user.role.index');
    }
}
