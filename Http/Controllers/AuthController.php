<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Laracasts\Flash\Flash;
use Modules\Core\Contracts\Authentication;
use Modules\Core\Http\Controllers\PublicBaseController;
use Modules\User\Entities\Entrust\EloquentUser;
use Modules\User\Events\UserHasBegunResetProcess;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\ResetCompleteRequest;
use Modules\User\Http\Requests\ResetRequest;
use Modules\User\Repositories\UserRepository;

/**
 * Class AuthController.
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
    ) {
        $this->user = $user;
        $this->auth = $auth;
        $this->redirectPath = route(config('society.user.config.redirect_route_after_login'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin(Request $request)
    {
        if (App::environment('demo')) {
            $request->session()->flashInput([
                'email'    => 'admin@societycms.com',
                'password' => 'secret',
            ]);
        }

        return view('user::public.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        if (! \Setting::get('user::enable-registration')) {
            return redirect()->route('login');
        }

        return view('user::public.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterRequest $request)
    {
        if (! \Setting::get('user::enable-registration')) {
            return redirect()->route('login');
        }
        
        \Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
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
     *
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return EloquentUser::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
