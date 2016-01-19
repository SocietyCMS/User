<?php

namespace Modules\User\Http\Controllers\api;

use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\ApiBaseController;
use Modules\Core\Http\Requests\MediaImageRequest;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\ProfilePictureTransformer;
use Modules\User\Transformers\UserTransformer;

class ProfileController extends ApiBaseController
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function store(MediaImageRequest $request, $id)
    {
        if($this->auth->user()->hasRole('admin')){
            $user = $this->user->find($id);
        } else {
            $user = $this->auth->user();
        }

        $user->clearMediaCollection('profile');
        $savedImage = $user->addMedia($request->files->get('image'))->toMediaLibrary('profile');

        return $this->response->item($savedImage, new ProfilePictureTransformer());
    }
}
