<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var array
     */
    protected $middleware = [
        'User' => [
            'auth.guest'  => 'GuestMiddleware',
            'loggedIn'    => 'LoggedInMiddleware',
            'userprofile' => 'UserProfileMiddleware',
            'role'        => 'Entrust\Role',
            'permission'  => 'Entrust\Permission',
            'ability'     => 'Entrust\Ability',
        ],
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware($this->app['router']);

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'user');
    }

    private function registerMiddleware($router)
    {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Modules\\{$module}\\Http\\Middleware\\{$middleware}";

                $router->middleware($name, $class);
            }
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\User\Repositories\UserRepository',
            "Modules\\User\\Repositories\\Entrust\\EntrustUserRepository"
        );

        $this->app->bind(
            'Modules\User\Repositories\RoleRepository',
            "Modules\\User\\Repositories\\Entrust\\EntrustRoleRepository"
        );
        $this->app->bind(
            'Modules\Core\Contracts\Authentication',
            "Modules\\User\\Repositories\\Entrust\\EntrustAuthentication"
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/user');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom([$viewPath, $sourcePath], 'user');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/user');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'user');
        } else {
            $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'user');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('user.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'user'
        );
    }
}
