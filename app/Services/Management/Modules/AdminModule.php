<?php

namespace App\Services\Management\Modules;

use App\Data\Dto\ProtectableDataViewerAction;
use App\Data\Enums\AdminManagementRoute;
use App\Foundation\Modules\Data\Contracts\ModulableMenu;
use App\Foundation\Modules\Data\Contracts\ModulableProtectable;
use App\Foundation\Modules\Data\Factory\Action;

class AdminModule implements  ModulableMenu, ModulableProtectable
{
    const KEY = 'admin';

    public function getModuleKey():string
    {
        return  self::KEY;
    }
    public function getModuleName():string
    {
        return  "Admin";
    }

    public function getMenuActions(): array {
        return [
            Action::redirect(AdminManagementRoute::DATA_VIEW->value, "List"),
            Action::redirect(AdminManagementRoute::CREATE->value, "Crear")
        ];
    }

    private function getTableActions(): array {
        return [
            ProtectableDataViewerAction::load(AdminManagementRoute::DATA->value),
            ProtectableDataViewerAction::create(AdminManagementRoute::CREATE->value),
            ProtectableDataViewerAction::edit(AdminManagementRoute::EDIT->value),
            ProtectableDataViewerAction::delete(AdminManagementRoute::DELETE->value)
        ];
    }

    public function getPermissions(): array {
        return  array_merge(
            self::getMenuActions(),
            self::getTableActions()
        );
    }

}
