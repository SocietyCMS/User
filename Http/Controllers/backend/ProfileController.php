<?php

namespace Modules\User\Http\Controllers\backend;

use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\User\Http\Requests\EditProfileRequest;
use Modules\User\Http\Requests\UpdateProfileContactRequest;
use Modules\User\Http\Requests\UpdateProfilePasswordRequest;
use Modules\User\Http\Requests\UpdateProfileUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;

/**
 * Class ProfileController
 * @package Modules\User\Http\Controllers\backend
 */
class ProfileController extends AdminBaseController
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
    )
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;

        $this->middleware('userprofile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function currentUser()
    {
        $user = $this->auth->check();

        return view('user::backend.profile.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileUserRequest|UpdateUserRequest $request
     * @return Response
     * @internal param int $id
     */
    public function updateUser(UpdateProfileUserRequest $request)
    {
        $input = [];

        if($this->auth->user()->can('user::change-own-name'))
        {
            $input = array_merge($input, [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        }

        if($this->auth->user()->can('user::change-own-email'))
        {
            $input = array_merge($input, [
                'email' => $request->email,
            ]);
        }

        $this->user->update($input, $this->auth->id());

        flash(trans('user::messages.profile updated'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileContactRequest|UpdateProfileUserRequest|UpdateUserRequest $request
     * @return Response
     * @internal param int $id
     */
    public function updateContact(UpdateProfileContactRequest $request)
    {
        $this->user->update($request->all(), $this->auth->id());

        flash(trans('user::messages.profile updated'));

        return redirect()->back();
    }

    /**
     * Update the password of the given user.
     *
     * @param UpdateProfilePasswordRequest|UpdateUserRequest $request
     * @return Response
     * @internal param int $id
     */
    public function updatePassword(UpdateProfilePasswordRequest $request)
    {

        $user = $this->user->find($this->auth->id());

        $credentials = [
            'id'       => $this->auth->id(),
            'email'    => $user->email,
            'password' => $request->old_password,
        ];

        if (!$this->auth->attempt($credentials)) {
            Flash::error(trans('user::messages.invalid old password'));

            return redirect()->back();
        }

        $this->user->update($request->all(), $this->auth->id());

        flash(trans('user::messages.password updated'));

        return redirect()->back();
    }
}
