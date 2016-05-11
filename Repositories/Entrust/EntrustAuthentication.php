<?php

namespace Modules\User\Repositories\Entrust;

use Illuminate\Support\Facades\Auth;
use Modules\Core\Contracts\Authentication;

class EntrustAuthentication implements Authentication
{
    /**
     * Authenticate a user.
     *
     * @param array $credentials
     * @param bool  $remember    Remember the user
     *
     * @return mixed
     */
    public function login(array $credentials, $remember = false)
    {
        return Auth::attempt($credentials, $remember);
    }

    /**
     * Register a new user.
     *
     * @param array $user
     *
     * @return bool
     */
    public function register(array $user)
    {
        // TODO: Implement register() method.
    }

    /**
     * Activate the given used id.
     *
     * @param int    $userId
     * @param string $code
     *
     * @return mixed
     */
    public function activate($userId, $code)
    {
        // TODO: Implement activate() method.
    }

    /**
     * Log the user out of the application.
     *
     * @return mixed
     */
    public function logout()
    {
        return Auth::logout();
    }

    /**
     * Create a reminders code for the given user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function createReminderCode($user)
    {
        // TODO: Implement createReminderCode() method.
    }

    /**
     * Completes the reset password process.
     *
     * @param        $user
     * @param string $code
     * @param string $password
     *
     * @return bool
     */
    public function completeResetPassword($user, $code, $password)
    {
        // TODO: Implement completeResetPassword() method.
    }

    /**
     * Determines if the current user has access to given permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function hasAccess($permission)
    {
        return true;
    }

    /**
     * Determines if the current user is in the given Role.
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (! $user = $this->check()) {
            return false;
        }

        return $user->hasRole($role);
    }

    /**
     * Determines if the current user has a given Permission.
     *
     * @param $role
     *
     * @return bool
     */
    public function can($permission)
    {
        if (! $user = $this->check()) {
            return false;
        }

        return $user->can($permission);
    }

    /**
     * Check if the user is logged in.
     *
     * @return mixed
     */
    public function check()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return false;
    }

    /**
     * Check if the user is logged in.
     *
     * @return mixed
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * Handle an authentication attempt.
     *
     * @param $credentials
     *
     * @return mixed
     */
    public function attempt($credentials)
    {
        return Auth::attempt($credentials);
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int
     */
    public function id()
    {
        if (! $user = $this->check()) {
            return;
        }

        return $user->id;
    }
}
