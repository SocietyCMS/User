<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Define which user driver to use.
     |--------------------------------------------------------------------------
     | Current default and only option : Sentinel
     */
    'driver' => 'Entrust',

    /*
    |--------------------------------------------------------------------------
    | Define which route to redirect to after a successful login
    |--------------------------------------------------------------------------
    */
    'redirect_route_after_login' => 'dashboard.index',
    /*
    |--------------------------------------------------------------------------
    | Login column(s)
    |--------------------------------------------------------------------------
    | Define which column(s) you'd like to use to login with, currently
    | only supported by the Sentinel user driver
    */
    'login-columns' => ['email'],

];
