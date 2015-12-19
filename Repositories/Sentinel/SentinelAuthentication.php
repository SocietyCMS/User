<?php

namespace Modules\User\Repositories\Sentinel;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Modules\Core\Contracts\Authentication;

class SentinelAuthentication implements Authentication
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
        try {
            if (Sentinel::authenticate($credentials, $remember)) {
                return false;
            }

            return 'Invalid login or password.';
        } catch (NotActivatedException $e) {
            return 'Account not yet validated. Please check your email.';
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();

            return "Your account is blocked for {$delay} second(s).";
        }
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
        $user = Sentinel::getUserRepository()->create((array) $user);
        $user->profile()->create([]);
        return $user;
    }

    /**
     * Assign a role to the given user.
     *
     * @param \Modules\User\Repositories\UserRepository $user
     * @param \Modules\User\Repositories\RoleRepository $role
     *
     * @return mixed
     */
    public function assignRole($user, $role)
    {
        return $role->users()->attach($user);
    }

    /**
     * Log the user out of the application.
     *
     * @return bool
     */
    public function logout()
    {
        return Sentinel::logout();
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
        $user = Sentinel::findById($userId);

        return Activation::complete($user, $code);
    }

    /**
     * Create an activation code for the given user.
     *
     * @param \Modules\User\Repositories\UserRepository $user
     *
     * @return mixed
     */
    public function createActivation($user)
    {
        return Activation::create($user)->code;
    }

    /**
     * Create a reminders code for the given user.
     *
     * @param \Modules\User\Repositories\UserRepository $user
     *
     * @return mixed
     */
    public function createReminderCode($user)
    {
        $reminder = Reminder::exists($user) ?: Reminder::create($user);

        return $reminder->code;
    }

    /**
     * Completes the reset password process.
     *
     * @param $user
     * @param string $code
     * @param string $password
     *
     * @return bool
     */
    public function completeResetPassword($user, $code, $password)
    {
        return Reminder::complete($user, $code, $password);
    }


    /**
     * Determines if the current user .
     *
     * @param $permission
     *
     * @return bool
     */
    public function hasAccess($permission)
    {
        if (!Sentinel::check()) {
            return false;
        }

        if (Sentinel::inRole('admin')) {
            return true;
        }
        return Sentinel::hasAccess($permission);
    }


    /**
     * validate user credentials
     *
     * @param $permission
     *
     * @return bool
     */
    public function validateCredentials($userId, array $credentials)
    {
        $user = Sentinel::findById($userId);
        return Sentinel::validateCredentials($user, $credentials);
    }

    /**
     * Determines if the current user is in the given Role.
     *
     * @param $role
     *
     * @return bool
     */
    public function inRole($role)
    {
        if (!Sentinel::check()) {
            return false;
        }

        return Sentinel::inRole($role);
    }

    /**
     * Check if the user is logged in.
     *
     * @return mixed
     */
    public function check()
    {
        return Sentinel::check();
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int
     */
    public function id()
    {
        if (!$user = $this->check()) {
            return;
        }

        return $user->id;
    }
}
