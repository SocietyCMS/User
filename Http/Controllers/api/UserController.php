<?php

namespace Modules\User\Http\Controllers\api;

use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\ApiBaseController;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;

class UserController extends ApiBaseController
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var RoleRepository
     */
    private $role;
    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @param UserRepository $user
     * @param RoleRepository $role
     * @param Authentication $auth
     */
    public function __construct(
        UserRepository $user,
        RoleRepository $role,
        Authentication $auth
    ) {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->auth = $auth;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $this->mergeRequestWithPermissions($request);
        $this->user->createWithRoles($data, $request->roles, $request->activated);

        return $this->successCreated();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int               $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->user->updateAndSyncRoles($id, $request->all(), $request->roles);

        return $this->successUpdated();
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
        $this->user->delete($id);

        return $this->successDeleted();
    }
}
