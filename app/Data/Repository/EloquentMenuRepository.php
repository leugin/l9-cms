<?php

namespace App\Data\Repository;

use App\Foundation\Menus\Data\Dto\SubMenu;
use App\Foundation\Menus\Data\Dto\Menu;
use App\Foundation\Menus\Data\Factory\Action;
use App\Foundation\Menus\Data\Repository\MenuRepository;
use App\Models\Admin;

class EloquentMenuRepository implements MenuRepository
{

    public function findByUser(Admin $admin): array
    {
        $all = $this->all();
        $available = [];
        /**@var Menu $menu**/
        foreach ($all as $menu) {
            if ($admin->can( $menu->getSlugPermission()))
            {
                $availableActions = [];
                foreach ($menu->actions as $action) {
                    if ($admin->can($action->getSlugPermission())){
                        $availableActions[] = $action;
                    }
                }
                if (sizeof($availableActions) > 0) {
                    $menu->actions = $availableActions;
                    $available[] = $menu;
                }
            }
        }
        return  $available;
    }

    public function all(): array
    {
        return [
            Menu::make('Gestion de administradores', 'management-admins')
                ->addSubMenu('Listar', 'list' , Action::url(route('management.dashboard')) )
                ->addSubMenu('Crear', 'creat' , Action::url(route('management.dashboard')) ),
            Menu::make('Gestion de usuarios', 'management-admins')
                ->addSubMenu('Listar', 'list' , Action::url(route('management.dashboard')) )
                ->addSubMenu('Crear', 'creat' , Action::url(route('management.dashboard')) ),
            Menu::make('Gestion de paginas', 'management-admins')
                ->addSubMenu('Listar', 'list' , Action::url(route('management.dashboard')) )
                ->addSubMenu('Crear', 'creat' , Action::url(route('management.dashboard')) ),
            Menu::make('Gestion de compras', 'management-admins')
                ->addSubMenu('Listar', 'list' , Action::url(route('management.dashboard')) )
                ->addSubMenu('Crear', 'creat' , Action::url(route('management.dashboard')) ),
            Menu::make('Gestion de permisos', 'management-admins')
                ->addSubMenu('Listar', 'list' , Action::url(route('management.dashboard')) )
                ->addSubMenu('Crear', 'creat' , Action::url(route('management.dashboard')) )
        ];
    }
}
