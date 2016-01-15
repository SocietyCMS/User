<?php

namespace Modules\User\Http\Controllers\backend;

use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\User\Http\Requests\EditProfileRequest;
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditProfileRequest $request, $id)
    {
        $user = $this->user->find($id);
        return view('user::backend.profile.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int               $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function updateUser(UpdateProfileUserRequest $request, $id)
    {
        $user = $this->user->find($id);
        $this->user->update($user, $request->all());

        flash(trans('user::messages.profile updated'));

        return redirect()->back();
    }

    /**
     * Update the password of the given user.
     *
     * @param int               $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function updatePassword(UpdateProfilePasswordRequest $request, $id)
    {

        $user = $this->user->find($id);

        $credentials = [
            'email'    => $user->email,
            'password' => $request->old_password,
        ];

        if(!$this->auth->validateCredentials($id, $credentials))
        {
            Flash::error(trans('user::messages.invalid old password'));

            return redirect()->back();
        }

        $this->user->update($user, ['password' => Hash::make($request->input('password'))]);


        $user->profile->update($request->all());

        flash(trans('user::messages.password updated'));

        return redirect()->back();
    }
}
