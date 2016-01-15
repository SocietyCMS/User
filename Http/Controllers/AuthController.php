<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\PublicBaseController;
use Modules\User\Events\UserHasBegunResetProcess;
use Modules\User\Exceptions\InvalidOrExpiredResetCode;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\ResetCompleteRequest;
use Modules\User\Http\Requests\ResetRequest;
use Modules\User\Repositories\UserRepository;

/**
 * Class AuthController
 * @package Modules\User\Http\Controllers
 */
class AuthController extends PublicBaseController
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var Authentication
     */
    private $auth;

    protected $redirectPath;

    /**
     * @param UserRepository $user
     * @param Authentication $auth
     */
    public function __construct(
        UserRepository $user,
        Authentication $auth
    )
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->redirectPath = route(config('society.user.config.redirect_route_after_login'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('user::public.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        if (!\Setting::get('user::enable-registration')) {
            return redirect()->route('login');
        }

        return view('user::public.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterRequest $request)
    {
        if (!\Setting::get('user::enable-registration')) {
            return redirect()->route('login');
        }

        app('Modules\User\Services\UserRegistration')->register($request->all());

        Flash::success(trans('user::messages.account created check email for activation'));

        return redirect()->route('login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->route('login');
    }

    /**
     * @param $userId
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate($userId, $code)
    {
        if ($this->auth->activate($userId, $code)) {
            Flash::success(trans('user::messages.account activated you can now login'));

            return redirect()->route('login');
        }
        Flash::error(trans('user::messages.there was an error with the activation'));

        return redirect()->route('login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReset()
    {
        return view('user::public.reset.begin');
    }

    /**
     * @param ResetRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws UserNotFoundException
     */
    public function postReset(ResetRequest $request)
    {

        $user = $this->user->findByCredentials(['email' =>$request->email]);

        if (!$user) {
            Flash::error(trans('user::messages.no user found'));

            return redirect()->back()->withInput();
        }

        $code = $this->auth->createReminderCode($user);

        event(new UserHasBegunResetProcess($user, $code));

        Flash::success(trans('user::messages.check email to reset password'));

        return redirect()->route('reset');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResetComplete()
    {
        return view('user::public.reset.complete');
    }

    /**
     * @param                      $userId
     * @param                      $code
     * @param ResetCompleteRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postResetComplete($userId, $code, ResetCompleteRequest $request)
    {

        $this->input = $request->all();

        $user = $this->user->find($userId);

        if (!$user) {
            Flash::error(trans('user::messages.user no longer exists'));

            return redirect()->back()->withInput();
        }


        if (!$this->auth->completeResetPassword($user, $code, $request->password)) {
            Flash::error(trans('user::messages.invalid reset code'));

            return redirect()->back()->withInput();
        }

        Flash::success(trans('user::messages.password reset'));

        return redirect()->route('login');

    }
}
