<?php

namespace Modules\User\Http\Middleware;

use Modules\Core\Contracts\Authentication;

class UserProfileMiddleware
{
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {

        if(\Setting::getBool('user::enable-profile') )
        {
            return $next($request);
        }

        \Flash::error(trans('user::messages.profile disabled'));
        return \Redirect::route('dashboard.index');
    }
}
