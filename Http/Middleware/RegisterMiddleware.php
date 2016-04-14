<?php

namespace Modules\User\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Setting;

class RegisterMiddleware
{
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
        if (Setting::get('core::enable-registration')) {
            return $next($request);
        }

        return Redirect::route(config('society.user.config.redirect_route_after_login'));
    }
}
