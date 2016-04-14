<?php

namespace Modules\User\Http\Controllers\backend;

use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\User\Events\UserHasBegunResetProcess;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\ResetRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\Entrust\Criteria\UserOrderCriteria;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;

class UserController extends AdminBaseController
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
     * @param UserRepository $user
     * @param RoleRepository $role
     * @param Authentication $auth
     */
    public function __construct(
        UserRepository $user,
        RoleRepository $role
    ) {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->user->pushCriteria(new UserOrderCriteria());
        $users = $this->user->all();

        return view('user::backend.users.index', compact('users', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user::backend.users.create');
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
        $this->user->createWithRoles($request->all(), $request->roles);

        flash(trans('user::messages.user created'));

        return redirect()->route('backend::user.user.index');
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
        if (!$user = $this->user->find($id)) {
            flash()->error(trans('user::messages.user not found'));

            return redirect()->route('backend::user.index');
        }

        return view('user::backend.users.edit', compact('user'));
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
        $this->user->updatewithRoles($request->all(), $request->roles, $id);

        flash(trans('user::messages.user updated'));

        return redirect()->route('backend::user.user.index');
    }

    /**
     * @param ResetRequest $request
     *
     * @throws UserNotFoundException
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function passwordResetRequest($id)
    {
        if (!$user = $this->user->find($id)) {
            flash()->error(trans('user::messages.user not found'));

            return redirect()->route('backend::user.index');
        }

        $code = $this->auth->createReminderCode($user);

        event(new UserHasBegunResetProcess($user, $code));

        Flash::success(trans('user::messages.reset password email sent'));

        return redirect()->route('backend::user.user.index');
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

        flash(trans('user::messages.user deleted'));

        return redirect()->route('backend::user.user.index');
    }
}
