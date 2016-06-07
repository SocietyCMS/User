<?php

namespace Modules\User\MenuExtenders;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.workshop'), function (Group $group) {
            $group->weight(20);

            $group->item(trans('user::users.title.users'), function (Item $item) {
                $item->weight(0);
                $item->icon('fa fa-user');
                $item->route('backend::user.user.index');
                $item->authorize(
                    $this->auth->can('user::manage-user')
                );
            });

            $group->item(trans('user::roles.title.roles'), function (Item $item) {
                $item->weight(1);
                $item->icon('fa fa-users');
                $item->route('backend::user.role.index');
                $item->authorize(
                    $this->auth->can('user::manage-role')
                );
            });
        });

        return $menu;
    }
}
