<?php

namespace App\Services\Management\Modules;

use App\Data\Dto\TableAction;
use App\Foundation\Modules\Data\Contracts\ModulableMenu;
use App\Foundation\Modules\Data\Contracts\ModulableProtectable;
use App\Foundation\Modules\Data\Factory\Action;

class AdminModule implements  ModulableMenu, ModulableProtectable
{
    public function getModuleKey():string
    {
        return  "admin";
    }
    public function getModuleName():string
    {
        return  "Admin";
    }

    public function getMenuActions(): array {
        return [
            Action::redirect('management.admins.index', "List"),
            Action::redirect('management.admins.create', "Crear")
        ];
    }

    private function getTableActions(): array {
        return [
            TableAction::create('management-admins-edit'),
            TableAction::load('management-admins-datatable'),
            TableAction::create('management-admins-store'),
            TableAction::create('management-admins-update')
        ];
    }

    public function getPermissions(): array {
        return  array_merge(
            self::getMenuActions(),
            self::getTableActions()
        );
    }

}
