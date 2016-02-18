<?php

view()->composer('user::backend.roles.partials.permissions', \Modules\User\Composers\PermissionsListComposer::class);
view()->composer('user::backend.fields.users', \Modules\User\Composers\UserListComposer::class);
view()->composer('user::backend.fields.roles', \Modules\User\Composers\RoleListComposer::class);
