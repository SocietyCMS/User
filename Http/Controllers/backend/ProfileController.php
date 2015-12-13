<?php

namespace Modules\User\Http\Controllers\backend;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\User\Http\Requests\EditProfileRequest;
use Modules\User\Http\Requests\UpdateProfileRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;

/**
 * Class ProfileController
 * @package Modules\User\Http\Controllers\backend
 */
class ProfileController extends BaseUserModuleController
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
    )
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->auth = $auth;
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
    public function update(UpdateProfileRequest $request, $id)
    {

        $user = $this->user->find($id);

        if($request->has('password'))
        {

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password'     => 'required|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

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
        }


        $user->profile->update($request->all());

        flash(trans('user::messages.profile updated'));

        return redirect()->back();
    }

    /**
     * @param UpdateProfileRequest $request
     * @param                      $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    private function updatePassword(UpdateProfileRequest $request, $id)
    {

        return true;

    }
}
