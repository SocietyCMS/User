<?php

namespace Modules\User\Providers;

use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Maatwebsite\Sidebar\Domain\Events\FlushesSidebarCache;
use Modules\Core\Permissions\PermissionManager;
use Modules\User\Events\Handlers\SendRegistrationConfirmationEmail;
use Modules\User\Events\RoleWasUpdated;
use Modules\User\Events\UserHasRegistered;
use Modules\User\Events\UserWasUpdated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserHasRegistered::class        => [
            SendRegistrationConfirmationEmail::class,
        ],
        UserWasUpdated::class           => [
            FlushesSidebarCache::class,
        ],
        RoleWasUpdated::class           => [
            FlushesSidebarCache::class,
        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        parent::boot($events);

        $events->listen('module.enabled', function ($module) {
            $permissionManager = new PermissionManager();
            $permissionManager->registerDefault($module);
        });
/*
        $events->listen('module.disabled', function ($module) {
            $permissionManager = new PermissionManager();
            $permissionManager->rollbackDefault($module);
        });
*/

        $events->listen('auth.login', function ($user) {
            $user->last_login = Carbon::now();
            $user->save();
        });
    }
}
