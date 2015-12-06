<?php

view()->composer('user::backend.roles.partials.permissions', \Modules\User\Composers\PermissionsListComposer::class);
view()->composer('user::backend.roles.partials.infoTab', \Modules\User\Composers\UserListComposer::class);